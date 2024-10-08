<!--
SPDX-FileCopyrightText: 2024 Bundesrepublik Deutschland, vertreten durch das BMI/ITZBund

SPDX-License-Identifier: GPL-3.0-or-later
-->

# Tenant Factsheet
The GSB 11 tenant factsheet is the first information point for the provision, configuration and customisation of the GSB 11.

## Goals
The aim of the tenant factsheet is to provide the developers with an initial clear and concise source of information regarding the provision, configuration and customisation of GSB 11. The factsheet shows the configuration and customisation options and points out any restrictions with regard to provision, configuration and operation.

The potential target groups of the tenant factsheet can be the following stakeholders:
- User of GSB 11 (government agencies)
- Service provider of government agencies
- Internal ITZBund Ops (IV B 2)
- Interface/API-Partner (Stellenanzeigen, Newsletter-Dienste etc.)

## General assumptions
- Only ITZBund hosting projects are considered
- For local development, ddev is supplied via the Sitepackage Kickstarter extension. ddev makes it easy to create a local development environment on all common operating systems incl. Windows. The environment is hosted in Docker containers, so shell commands only.
- Each tenant starts their development with the Kickstarter sitepackage
- Each tenant versions their code on the GSB 11 Gitlab
- TYPO3 core version is integrated as MAJOR.MINOR definition via gsb_core

For the development of the GSB 11 distribution and the customised tenants, a Microsoft Azure cloud computing platform is made available to the service provider by the ITZBund. The GSB 11 TYPO3 distribution is created and maintained in this Azure development environment. It also provides the infrastructure for tenant development based on GitLab.

The Azure development environment and GSB Hosting are closely linked. It should be noted once again at this point that the development of the GSB 11 distribution and the tenant development takes place outside of ITZBund Hosting. The ITZBund hosting environment only accesses the so-called delivery items in the Azure development environment. This consists of images and Helm Charts. The tenant is included as a finished image in the Azure development environment.

- Tenant development: The actual tenant development takes place on the government agencies side or at the commissioned agency.
- The tenant developer can obtain a Kickstarter development environment (ddev) from the GitLab of the Azure development environment for this purpose.
- Azure development environment ITZBund: The tenant's code can be delivered via the GitLab of the Azure development environment.
- The tenant code is checked, tested and integrated into the delivery item in this environment.
- Hosting ITZBund: In the hosting environment, the delivery item is checked for security vulnerabilities and then deployed to ATU or, after approval, to production (deployment)

## Extension option 1 - Extension via configuration
### Configuration items
Extension option 1 is intended to provide tenants with a quick and easy way to configure and customise GSB 11. In this context, GSB 11 can be customised in the first step by simple configuration according to the individual requirements of the tenant.

What can be configured using TYPO3's simple graphical user interface (UI)?
- URL/Domain
- Logo
- Favicon
- Social Media Channel
- Website Title
- Copyright text in Footer
- Page IDs (PIDs) of navigation
- google-site-verification
- facebook-domain-verification
- CSP
- Colors
- Bootstrapvariables
- Typ of navigation

### How are these settings made?
- Via the backend module "Site Management → Sites" which is visible in the UI

## Extension option 2 - Extension via a site package
Extension option 2 includes all the options from option 1.

Extensions to GSB 11 are generally also possible for tenants. But don't experiment and don't look for shortcuts that compromise the overall quality. Get in touch with us and we will define a joint solution that can perhaps also be shared with other users.

> **Shared responsibility**
>
> The principle of shared responsibility applies to customisation using Sitepackage!
> As the tenant developer, you are responsible for extensions or customisations to GSB 11. This applies in particular to things that have a negative impact on the security and performance of the overall system. The GSB 11 team ensures and monitors the performance of the basic system. If a tenant is negatively affected by tenant-specific customisations, you as the tenant developer are responsible for rectifying the problem.

### Configuration items
How and where can a developer make these settings from option 1 if a sitepackage is available?

- The configuration can be carried out via the Sitepackage Extension in the form of a TYPO3 Site Config.
- Naming convention: Site identifier must be identical to the path of the config file.
- Location: config.yaml
- The config of the Sitepackage Extension can be included in the /config/sites Config to avoid double maintenance.
- The config.yaml contains concrete examples for all configurable elements.

> **Notes**
>
> - The Site Package Config folder (/config) is not processed for deployment to test and production systems but is only used for the local development environment.
> - The configuration of the test and production systems is carried out by the GSB 11 team.
> - Changes that require adjustments to the settings.php for local development will be announced via GSB 11 release notes.

### Extension functional scope
#### PHP Packages/TYPO3 Extension
- Additional PHP packages can be integrated via Composer.
- Only certain packages are permitted (Allowlist). These are checked with every commit. See chapter Gitlab as gatekeeper for site packages.
- The packages must be agreed with the GSB 11 team. Contact us if you have requirements that go beyond the GSB 11 functional scope.

#### PHP Classes
- PHP classes can be placed in the Classes/ folder of the sitepackage extension.
- If suitable namespaces are used for the classes, the system can load these files automatically.
- See also https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ExtensionArchitecture/FileStructure/Classes/Index.html

### Extension Template & Design
#### Goals & framework conditions
- GSB 11 strives for a frontend stack that can be updated efficiently, i.e. only a few npm packages are used.
- The standard design and template system of GSB 11 (GSB 11 Frontend) is based on Bootstrap 5, i.e. the markup of GSB 11 follows the Bootstrap specifications and has been supplemented by TYPO3-specific markup and fluid variables. The official Bootstrap documentation is therefore very helpful when customising the template and design system.
- All GSB 11 extensions and thus also the components of the GSB 11 frontend use SemVer 2.0, which means that minor and patch releases of gsb_core and gsb_frontend can be imported into all tenants without hesitation.
- Tenant developers receive a changelog for each frontend component, which can be used to assess
  - whether a component is affected by a change
  - whether it is a breaking change for this component
  - which parts of the component are affected by the change, e.g. HTML, styles, assets, JavaScript, settings, markup.
- It is possible to create your own build process within your site package.
- The GSB 11 markup does not contain any visual definitions and therefore enables a high degree of reusability, i.e. overwriting fluid templates should only rarely be necessary.

#### Structure
The definition of the template and design system supplied with GSB 11 can be found in the two extensions gsb_core and gsb_frontend.
- gsb_core: TYPO3 Fluid Templates
- gsb_frontend: (S)CSS, JavaScript

In order to make tenant-specific customisations, it is NOT necessary to adapt these two extensions. All customisations are made in the tenant-specific sitepackage extension.
- gsb_sitepackage

GSB 11 provides a federal style guide-compliant and barrier-free template and design system. In order to benefit from GSB 11 in this area in the future, tenant-specific customisations must be made according to defined rules. Only then can it be ensured that updates, in particular patches according to SemVer 2.0 (see also GSB 11 patch concept), can be imported into the tenant version of GSB 11 without errors.

Adjustments can be made to the template and design system in the following places:

- Site Config:
  - See also extension option 1.
  - Adjustments to e.g. logo, colours.
  - Activation of feature toggles to activate certain functions (incl. templates), e.g. search.
- (S)CSS in /Resources/Public/StyleSheets
  - Tenant-specific CSS definitions that supplement and/or overlay the GSB 11 stylesheet from the gsb_frontend extension.
  - Expected output path: /Resources/Public/StyleSheets
  - Definition of the path via TypoScript in /Configuration/TypoScript/setup.typoscript
  - The build process can be defined on a tenant-specific basis as long as the output path is adhered to.
- JavaScript in /Resources/Public/JavaScripts
  - Overlay tenant-specific JavaScript definitions that supplement the GSB 11 stylesheet
  - Output path: /Resources/Public/JavaScripts
- package.json
  - A tenant-specific node-based build stack can be defined.#
  - MUST: npm run build is defined to build the frontend.
- Fluid Templates
  - Fluid templates should NOT be overwritten, as this jeopardises the update capability of the gsb_core extension in particular.
  - If templates/partials are overwritten, this should be done sparingly.
  - Overwriting templates/partials is done according to standard TYPO3 procedures.

### Documentation extensions
- Tenant-specific extensions to the documentation can be placed as Markdown files in the Documentation/ sitepackage extension folder.
- Example: https://git.gsb-itzbund.de/gsb11/extensions/gsb_core/-/tree/main/Documentation?ref_type=heads

## Development Process
### Gitlab Organisation
- Institution
  - All tenant site packages are versioned at https://git.gsb-itzbund.de/gsb11/sitepackages.
  - A subgroup is created for each institution. Example https://git.gsb-itzbund.de/gsb11/sitepackages/itzbund.
  - A deploy token is created for each institution in the subgroup extension (https://git.gsb-itzbund.de/groups/gsb11/extensions/-/settings/repository) with username institution name (example: itzbund) and read_package_registry.
  - All tokens within GitLabs expire after 12 months.
- User
  - Developers of the institution are assigned to the subgroup of the institution.
  - 1- 2 developers are assigned the Owner role for the institution's subgroup.
  - All other developers are assigned the Maintainer role for the institution's subgroup.
  - All developers are assigned the Developer role for the subgroup Extensions.
  - 2FA must be activated.
  - All user accounts expire after 12 months. (question)
  - All user accounts receive the Reporter role in the Gitlab Scripts repository so that the CI can be executed.
- Tenant repository
  - A repository for the sitepackage extension/config.yaml is created for each tenant below the subgroup of the institution.
  - The naming scheme of the repository is: MANDATENID (see release concept GSB 11).
- Build und Deploy Pipelines
  - The tenant sitepackage contains a .gitlab-ci.yml that integrates the central standard pipeline.
  - The artefacts are always given a version number according to SemVer 2.0 in the following scheme: SITEPACKAGE-MANDENTENID.
    - SITEPACKAGE is a SemVer version number.
    - MANDATENID is a string for identifying the tenant.
  - The pipeline builds
    - Composer Package of the Sitepackage Extension. Storage in tenant repository.
    - httpd container withComposer Package of the Sitepackage Extension. Storage in central container repository.

- HelmCharts & Images
  - A token with read authorisation for the HelmCharts registry is created.
  - Images (HTTPD) are mirrored in the tenants repo.

### Quality inspection & gatekeeping
Quality and conformity are continuously ensured in an automated process. Developers receive the best possible support and are informed of quality and compliance problems at an early stage, usually by email from the Gitlab pipelines.

The most important rules are already checked locally. This is implemented using Githooks (pre-commit).

After the commit and push to GSB 11 Gitlab, further checks and tests are carried out in sitepackage pipelines.

The results of these tests are made available to the tenant development team on an ongoing basis.

The basic components of GSB 11 are subjected to a BSI web check at regular intervals. These components can therefore be regarded as tested. However, adjustments/additions to PHP classes and JavaScript within a tenant site package in particular can trigger the need for a new check (simplified partial web check). These additions are recognised upon delivery and tenant developers may be informed of this within the Gitlab pipeline or by email.


### Gitlab as Gatekeeper for Sitepackages
Each site package is subjected to checks and tests after each commit:

- Typoscript Linter
- Conventional commits are checked.
- Each commit on main triggers release on test system
- Each release is merged to the branch "release" - this triggers the release process towards ITZBund
- The central sitepackage build pipeline expects an existing frontend build under the command npm run build.
- Only listed Composer packages are allowed, especially TYPO3 packages.
- Node packages are not regulated.

Failure of the CI pipeline leads to notification via e-mail or other self-configured Gitlab connections/integrations.

## Infrastructure
### Deployment of tenant test system on Azure

- Helm structure
  - All service containers are identical per tenant. They may differ in the version/tag per tenant.
  - All tenants use the same gsb11-helm chart. They may differ in the version/tag per tenant (question).
  - The gsb11-helm chart contains global values.
  - A tenant uses the clietenantnt-specific httpd image.
  - There is a central repository for tenant-specific Helm values. The value file follows the naming scheme MANDENTENID.yaml
- 1 test system Web access per tenant is provided (question)
- Creation process: (question)
- Naming scheme: (question)

### Domains und Domain Aliases
ITZBund only provides the main domain and a certain number of subdomains for the productive system.

Aliases: (Sub)domains can be requested from an external service provider. These can then redirect to the main domain in ITZBund.

## Information for developers
- The quality gates are based on the best practice recommendations for TYPO3 12 https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/CodingGuidelines/CglPhp/CodingBestPractices/Index.html
- The GSB 11 in the ITZBund is executed as a cluster, therefore it must be noted:
  - typo3temp is not used
  - the options CONFIG compressCss, compressJs, concatenateCss, concatenateJS are not used
  - no SQL queries are used, Doctrine DBAL / Extbase is used for all DB operations
  - Database caches are stored in Redis, for this purpose
        \ITZBand\GsbCore\Cache\Backend\SentinelCapableRedisBackend::class
         is used.
  - All connections in the cluster are encrypted and the services must authenticate themselves!
  - All connections are established persistently and with connection pooling
  - There is a cache proxy in front of the HTTPD pods.
