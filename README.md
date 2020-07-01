# Redirect From Identifier

## Overview

This Drupal module redirects requests from `/identifier/{identifier}` to the node that has the value of `{identifier}` in one of the configured fields. This functionality enables URLs that do not rely on node IDs. The standard way to do this is to use the Drupal core URL alias functionality. But, the Redirect From Identifer module allows you to assign a URL to a node before the node exists in Drupal, or for people to compose a link to a node if they don't know its node ID but do know its identifier (for example in external systems). The original use case for this functionality was to be able to mint URLs for electronic theses in an upstream workflow before the thesis was ingested into a Drupal-based institutional repository. Additional uses include:

* Using someone's campus ID as an identifier: http://example.com/identifier/mjordan (assumes that "Campus computing ID" is a registered identifer field on the node representing mjordan)
* Using someone's ORCID as an identifier: http://example.com/identifier/0000-0002-2327-4253 (assumes that ORCID is a registered identifer field on the node representing person with ORCID 0000-0002-2327-4253)

If a user goes to `/identifier/{identifier}`, they will be automatically redirected to the node that has `{identifier}` as a value in one of the fields configurable by the site administrator. Although it is unlikely to happen in the wild, if an identifer resolves to more than one node, the user is presented with a list of all the nodes and gets to choose the one they want.

If the identifier included in the URL does not resolve to any nodes, Drupal responds with a 404 Not Found.

## Configuration

Go to `admin/config/redirect_from_identifier` and enter a comma-delimited list of field machine names that contain identifiers.

## Requirements

* [Drupal 8](https://github.com/Islandora/islandora)

This module is Drupal 9 ready.

## Installation

1. Clone this repo into your Islandora's `drupal/web/modules/contrib` directory.
1. Enable the module either under the "Admin > Extend" menu or by running `drush en -y redirect_from_identifier`.

## Current maintainer

* [Mark Jordan](https://github.com/mjordan)

## License

[GPLv2](http://www.gnu.org/licenses/gpl-2.0.txt)
