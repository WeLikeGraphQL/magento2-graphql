#GraphQL API for Magento2

[![Gitter][gitter-img]][gitter-link]
[![Build Status](https://travis-ci.org/WeLikeGraphQL/magento2-graphql.svg?branch=master)](https://travis-ci.org/WeLikeGraphQL/magento2-graphql)
[![Coverage Status](https://coveralls.io/repos/WeLikeGraphQL/magento2-graphql/badge.svg?branch=master&service=github)](https://coveralls.io/github/WeLikeGraphQL/magento2-graphql?branch=master)

[gitter-img]: https://badges.gitter.im/Join%20Chat.svg
[gitter-link]: https://gitter.im/WeLikeGraphQL/magento2-graphql?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge

##Installation

Install this magento2 module using composer:
```
composer require we-like-graphql/magento2-graphql
```

It exposes GraphQL Endpoint at:
```
http://<your_magento2_path>/index.php/graphql
```

We highly recommend using [GraphIQL Feen](https://chrome.google.com/webstore/detail/graphiql-feen/mcbfdonlkfpbfdpimkjilhdneikhfklp) to explore this endpoint.

##List of covered [Magento's REST APIs](http://devdocs.magento.com/swagger/)
 - [backendModuleService](http://devdocs.magento.com/swagger/#!/backendModuleServiceV1)
 - [catalogCategoryAttributeRepository](http://devdocs.magento.com/swagger/#!/catalogCategoryAttributeRepositoryV1)
 - [catalogCategoryManagement](http://devdocs.magento.com/swagger/#!/catalogCategoryManagementV1)
 - [catalogCategoryRepository](http://devdocs.magento.com/swagger/#!/catalogCategoryRepositoryV1)
 - [catalogProductAttributeRepository](http://devdocs.magento.com/swagger/#!/catalogProductAttributeRepositoryV1)
 - [catalogProductRepository](http://devdocs.magento.com/swagger/#!/catalogProductRepositoryV1)

