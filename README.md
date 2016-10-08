# Hubzilla Addons
---
[Hubzilla](http://hubzilla.org) is a powerful platform for creating interconnected websites featuring a decentralized identity, communications, and permissions framework built using common webserver technology. 

This is a repository of **addons** (also known as **plugins**) that extend the functionality of the core Hubzilla installation in various ways. More about the various addons, discussion and development under [sasiflo hubzilla development channel](https://sasiflo.de/channel/sasiflo_hubzilla_dev).

### Installation

To install, use the following commands (assuming `/var/www/` is your hub's web root):

```
cd /var/www/
util/add_addon_repo https://github.com/sasiflo/hubzilla-addons-sasiflo.git addons_sasiflo
util/update_addon_repo addons_sasiflo
```
Then enable the individual plugins through the admin settings interface.

## Plugins
---

