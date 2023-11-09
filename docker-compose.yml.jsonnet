local ddb = import 'ddb.docker.libjsonnet';

# Gestion du DNS de dev
local domain_ext = std.extVar("core.domain.ext");
local domain_sub = std.extVar("core.domain.sub");
local domain = std.join('.', [domain_sub, domain_ext]);

local web_workdir = "/var/www/html/";
local app_workdir = "/app";

# Objet de la base de données
local db = {
    password: 'sf6',
    root_password: 'sf6',
    user: self.password
};

ddb.Compose() {
    services: {
        php:    ddb.Build("php") +
                ddb.User() +
                ddb.Binary("composer", "/var/www/html", "composer") +
                ddb.Binary("php", "/var/www/html", "php") +
                ddb.Binary("rector", "/var/www/html", "rector") +
                ddb.Binary("phpcs", "/var/www/html", "phpcs")  +
                ddb.Binary("phpcbf", "/var/www/html", "phpcbf")  +
                ddb.Binary("robo", "/var/www/html", "robo") +
                ddb.Binary("symfony", "/var/www/html", "symfony") +
                (if ddb.env.is("dev") then ddb.XDebug() else {}) +
                {
                    volumes+: [
                        ddb.path.project + ":/var/www/html",
                        ddb.path.project + "/.docker/php/sf6-php.ini:/usr/local/etc/php/conf.d/php-config.ini",
                        ddb.path.project + "/.docker/php/msmtprc:/etc/msmtprc",
                        "php-composer-cache:/composer/cache",
                        "php-composer-vendor:/composer/vendor"
                    ]
                },
          db: ddb.Build("db") +
    	    ddb.User() +
            ddb.Binary("mysql", "/workdir", "mysql -h db-sf6 -u sf6 -p sf6 -D sf6") +
            ddb.Binary("mysqldump", "/workdir", "mysqldump -h db-sf6 -u sf6 -p sf6 -D sf6") +
            ddb.Expose("3306", "51") +
            {
                environment+: {
                    MYSQL_ROOT_PASSWORD: "sf6",
                    MYSQL_DATABASE: "sf6",
                    MYSQL_USER: "sf6",
                    MYSQL_PASSWORD: "sf6"
                },
                volumes+: [
                    ddb.path.project + ":/workdir",
                    "db-sf6-data:/var/lib/mysql"
                ]
            },
        web:    ddb.Build("web") +
                ddb.VirtualHost("80", domain) +
                ddb.VirtualHost("80", std.join('.', ["dev", domain]),"dev") +
                {
                    volumes+: [
                        ddb.path.project + ":" + web_workdir,
                        ddb.path.project + "/.docker/web/apache.conf:/usr/local/apache2/conf/custom/apache.conf",
                    ]
                },
        node:   ddb.Build("node") +
                ddb.VirtualHost("3000", ddb.subDomain("live"), "live") +
                ddb.Binary("conventional-changelog", app_workdir, "conventional-changelog", "--label traefik.enable=false") +
                ddb.Binary("node", app_workdir, "node", exe=true) +
                ddb.Binary("webpack", app_workdir, "webpack", exe=true) +
                ddb.Binary("start-storybook", app_workdir, "storybook", exe=true) +
                ddb.Binary("webpack-cli", app_workdir, "webpack-cli", exe=true) +
                ddb.Binary("npm", app_workdir, "npm", exe=true) +
                ddb.Binary("npx", app_workdir, "npx", exe=true) +
                ddb.Binary("yarn", "/app", "yarn", exe=true) +
                {
                    volumes+: [
                        ddb.path.project + ":" + app_workdir,
                        "node-cache:/home/node/.cache",
                        "node-npm-packages:/home/node/.npm-packages"
                    ],
                    tty: true
                },
    }
}
