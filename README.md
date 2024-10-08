<!--
SPDX-FileCopyrightText: 2024 Bundesrepublik Deutschland, vertreten durch das BMI/ITZBund

SPDX-License-Identifier: GPL-3.0-or-later
-->

<!-- PROJECT SHIELDS -->
[![TYPO3 12](https://img.shields.io/badge/TYPO3-12-orange.svg)](https://get.typo3.org/version/12)

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/gsb-sitepackage-kickstarter">
    <img src="https://produkt.gsb.bund.de/SiteGlobals/Frontend/Images/logo.png?__blob=normal&v=1" alt="Logo" width="300">
  </a>

<h3 align="center">GSB&nbsp;11 Sitepackage Kickstarter</h3>

  <p align="center">
    Jumpstart your GSB&nbsp;11 powered tenant development.
    <br>
    <br>
    <a href="https://demo.gsb-itzbund.de/">See the Demo</a>
    <small><small>(you'll need a username & password)</small></small>
  </p>
</div>

## About
The **GSB Sitepackage Kickstarter** will help you to get started with GSB&nbsp;11 tenant development. After completing the steps below, you will have a local development environment with sample content up and running. You will be able to commit your tenant configuration and development to your tenant GitLab repository.

## Tenant Factsheet
Please have a first look into the [Tenant Factsheet](https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/gsb-sitepackage-kickstarter/-/blob/main/FACTSHEET.md) upfront and use it as a reference for all questions regarding your tenant GSB 11 project.

## Prerequisites
You need a few things upfront:

- [ddev][ddev-url] installed on your computer
- php version 8.2 installed on your computer including the [required extensions][typo3-requirements-url]
- [composer][composer-url] installed on your computer
- Login details (Username, Password) to GSB&nbsp;11 GitLab or OpenCoDE
- (GSB&nbsp;11 GitLab only) Deploy token (Username, Password) to GSB&nbsp;11 GitLab
- (GSB&nbsp;11 GitLab only) [SSH key setup][gitlab-ssh-url] to communicate with GitLab
- (GSB&nbsp;11 GitLab only / tenant development only) Git remote address for your own tenant sitepackage Git repository


## Preparation if you use OpenCoDE

1. **Authenticate with OpenCoDE**
   ```sh
   composer config -g gitlab-domains gitlab.opencode.de
   composer config -g repositories.gsb-sitepackage vcs https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/gsb-sitepackage-kickstarter.git
   composer config -g repositories.a11y-backend vcs https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/a11y_backend.git
   composer config -g repositories.captainhook-hooks vcs https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/captainhook-hooks.git
   composer config -g repositories.gsb-core vcs https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/gsb_core.git
   composer config -g repositories.gsb-feusermanagement vcs https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/gsb_feusermanagement.git
   composer config -g repositories.gsb-metadata-cleaner vcs https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/gsb_metadata_cleaner.git
   composer config -g repositories.gsb-widgets vcs https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/gsb_widgets.git
   ```

   Set user and password (use your personal access token as password)
   ```sh
   composer config -g gitlab-token.gitlab.opencode.de <PASSWORD>
   ```

## Preparation if you use git.gsb-itzbund.de

1. **Authenticate with GSB&nbsp;11 GitLab**
   ```sh
   composer config -g gitlab-domains git.gsb-itzbund.de
   composer config -g repositories.63 composer https://git.gsb-itzbund.de/api/v4/group/63/-/packages/composer/packages.json
   ```

   Set user and password
   ```sh
   composer config -g gitlab-token.git.gsb-itzbund.de <PASSWORD>
   ```

## Installation

---
**NOTE**

We use Linux and macOS in our team, so the Windows setup may not work without errors.

If you are developing on Windows, use ddev in WSL2 and enter the following commands in the Linux shell.

If you notice an error, please [contribute](#contribute) your solution.

---

Follow the steps to set up a GSB&nbsp;11 website with this sitepackage as a composer root package.

1. **Create GSB&nbsp;11 project**
   ```sh
   composer create-project itzbund/gsb-sitepackage gsb11-mandant && cd gsb11-mandant
   ``` 
   **If this command fails, try this workaround.**

    ```sh
   cd gsb11-mandant
   composer config --unset repositories.63
   composer install
   
   ```
   **OR**
   remove the folowing from the composer.json
      ```json
       "repositories": {
            "63": {
                "type": "composer",
                "url": "https://git.gsb-itzbund.de/api/v4/group/63/-/packages/composer/packages.json"
            }
        }
   
       
    than run composer install
   ``` 
1. **Start local development environment**
   ```sh
   ddev start
   ```

1. **GSB&nbsp;11 GitLab only! Add Additional Extension**

   Template including "Styleguide des Bundes"

    ```sh
    composer require itzbund/gsb-frontend
    ```

   Demo Content

    ```sh
    composer require itzbund/gsb-distribution
    ```

1. **Install GSB&nbsp;11**
   ```sh
   ddev exec cp .composer/vendor/typo3/cms-install/Resources/Private/FolderStructureTemplateFiles/root-htaccess .build/public/.htaccess && \
   ddev exec .composer/bin/typo3 setup --force \
   --no-interaction \
   --server-type=apache \
   --driver=mysqli \
   --username=db \
   --password=db \
   --port=3306 \
   --host=db \
   --dbname=db \
   --admin-username=admin \
   --admin-user-password=Pas§§wor1 \
   --admin-email='' \
   --project-name="GSB11" \
   --create-site="https://gsb-sitepackage.ddev.site"
   ```
   > NOTICE:
   > This configuration is used exclusively in the local development environment.
   > **The configuration is discarded in the deployment process!**
   > Please use a secure password

1. **Install extensions**
   ```sh
   ddev exec .composer/bin/typo3 extension:setup
   ```

   **GSB&nbsp;11 GitLab only! (optional)** You can remove the Distribution Extension. The dummy content (page tree and files) is already loaded. The extension is now obsolete.
   ```sh
   ddev composer remove itzbund/gsb-distribution
   ```

1. **Launch project**
   ```sh
   ddev launch
   ```

1. **Login Backend**

   Visit https://gsb-sitepackage.ddev.site/typo3 in your browser
   or use the
   ```sh
   ddev launch /typo3
   ```
   > NOTICE: You defined Username and Password in step 4 "Install GSB 11".

1. **GSB&nbsp;11 GitLab only! Initialize Git and add remote repository**
   ```sh
   git init --initial-branch=main
   git remote add origin https://git.gsb-itzbund.de/gsb11/sitepackages/<NAME OF YOUR TENANT SITEPACKAGE REPOSITORY>
   git add .
   git commit -m "Initial commit"
   git push --set-upstream origin main
   ```

1. **Configure your GSB&nbsp;11 tenant** 🚀

<!--
1. **Login into the editor backend**
TBD
add Password
1. **Remove extensions you don't need**
TBD
1. **Configure your GSB**
TBD
-->

## Notes

For further information, please refer to the readmes of the extensions. A list of available extensions is included in the Mandate Factsheet.


### Development

Explanations about caching in GSB 11 and the CI/CD pipelines in development are stored in the GSB 11 GitLab documentation project.

To successfully release a mandate version of GSB 11, the site package must be developed with trunk-based development, with `main` being the standard branch. A merge into `release` triggers a stable release. The branches `main` and `release` are mandatory.



## Contribute
As with TYPO3, we encourage you to join the project by submitting changes. Development of the GSB&nbsp;11 happens mainly in the GSB&nbsp;11 TYPO3 extensions.

To get started, have a look at our [detailed contribution walkthrough](https://gitlab.opencode.de/bmi/government-site-builder-11/extensions/gitlab-profile/-/blob/main/CONTRIBUTING.md).

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[composer-url]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos
[ddev-url]: https://ddev.readthedocs.io/en/stable/
[gitlab-ssh-url]: https://docs.gitlab.com/ee/user/ssh.html
[typo3-requirements-url]: https://docs.typo3.org/m/typo3/tutorial-getting-started/12.4/en-us/SystemRequirements/Index.html
