# wp-multi-site
Independent WordPress instances but all running on the same codebase.

## How to use

- setting up the domain in Apache or Nginx: the virtual directory is the repository root, where is the `wp-config.php` and the `sites` sub-directory
- change `sites/example.tld` folder with your web site name
- move `wp-config.example.php` for every sites to `wp-config.php` and change database credentials and SALT keys.