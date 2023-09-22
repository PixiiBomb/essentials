# Getting Started

1. Install the package
2. Run `php artisan vendor:publish --provider="PixiiBomb\Essentials\PixiiBombEssentialsServiceProvider"`
3. Run `php artisan migrate`

# About the ServiceProvider

The `PixiiBombEssentialsServiceProvider` is intended to do the following:

1. Publish package resources to your local project
   - This will create copies of useful components and views that you can alter to fit your project needs. 
2. Set the default Schema string length to 191 to avoid common database errors. `Schema::defaultStringLength(191)`
    - If your local project's Service provider already set's this value, it shouldn't cause an issue.
3. Create a namespace for PixiiBomb Components. You can use the original components, as is, or override the copies when the vendor files were published.
4. Add an @debug blade directive 

# How is this better than vanilla Laravel?

Laravel does an excellent job of creating a better starting point for backend development. This package takes the starting point a few steps further by providing a cohesive system to implement views without rewriting large chunks of code. This is great for templated websites that you plan to build upon, without having to rewrite some boiler-plate logic from scratch every time you start a new project.

Even if you're not interested in PageController logic, you might find it helpful to use PixiiComponents. These are Bootstrap-based components that you can tailor to your needs for all of your projects. You can choose to use the components without the PageController logic, or take advantage of everything this package has to offer!

# Principles

I'm a firm believer in D.R.Y principles. When I was a little girl, I too would make the mistake of writing the same syntax over and over in multiple files, only to change my mind and have to update the same code 50 times.

# Naming Conventions

In Laravel, the naming conventions for methods and functions generally follow common PHP naming conventions, with some Laravel-specific conventions for certain types of methods. Here are the key naming conventions for methods and functions in Laravel:

1. **Camel Case**: Method and function names should be in camel case. This means that the first letter should be lowercase, and the first letter of each subsequent word should be capitalized. For example:

    
    public function getUserProfile() { ... }

2. **HTTP Verb Prefixes**: In Laravel's controllers, methods handling HTTP requests typically use HTTP verb prefixes to indicate the type of request they handle. For example:
   - `get` prefix for handling GET requests.
   - `post` prefix for handling POST requests.
   - `put` prefix for handling PUT requests.
   - `delete` prefix for handling DELETE requests.


    public function getProfile() { ... }
    public function postCreate() { ... }
    public function putUpdate() { ... }
    public function deleteDestroy() { ... }

3. **Resource Controller Methods**: When you create a resource controller in Laravel, it often follows a standard set of methods that correspond to CRUD (Create, Read, Update, Delete) operations. These methods have specific names:

    - `index` for displaying a list of resources.
    - `create` for displaying a form to create a new resource.
    - `store` for handling the creation of a new resource.
    - `show` for displaying a single resource.
    - `edit` for displaying a form to edit an existing resource.
    - `update` for handling the update of an existing resource.
    - `destroy` for handling the deletion of an existing resource.


    public function index() { ... }
    public function create() { ... }
    public function store() { ... }
    public function show($id) { ... }
    public function edit($id) { ... }
    public function update($id) { ... }
    public function destroy($id) { ... }

4. **Custom Controller Methods**: For methods that don't follow the standard resource controller actions, you can choose descriptive names that convey the purpose of the method. For example, if you have a method that retrieves user notifications, you might name it getUserNotifications.
5. **Service Methods**: In service classes or helper classes, method names should also be descriptive and follow camel case. For example, getUserProfileData or formatUserName. 
6. **Testing Methods**: In Laravel PHPUnit test classes, test methods are prefixed with test and use camel case for their names. For example, testUserCanViewProfile.

Remember that consistency in naming is essential for code readability and maintainability. Laravel's core follows these conventions, and it's a good practice to adhere to them in your Laravel applications as well.
