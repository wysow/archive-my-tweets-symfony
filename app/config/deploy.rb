set :application, "archive-my-tweets"
set :domain,      "kimsufi1"
set :deploy_to,   "/var/www/#{application}.wysow.fr"
set :app_path,    "app"

default_run_options[:pty] = true

set :repository,  "git@github.com:wysow/archive-my-tweets-symfony.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

set :deploy_via, :remote_cache

set :ssh_options, {:forward_agent => true}

set   :use_sudo,      false

set :shared_files,      ["app/config/parameters.yml"]

set :shared_children,     [app_path + "/logs", web_path + "/uploads", "vendor"]

set :use_composer, true

set :composer_options,  "--no-dev --verbose --prefer-dist --optimize-autoloader"

set :copy_vendors, true

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL

after "deploy", "deploy:cleanup"