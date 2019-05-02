# Learning ES6 with Jeffrey Way
## ES2015 Crash Course
link [https://laracasts.com/series/es6-cliffsnotes/][1]

These are my notes from the ES2015 Crash Course by Jeffrey Way.

## No more VAR, use LET and CONST
ES6 introduces two new keywords for declaring variables: let and const.

Replace variables`var` use `let` instead to avoid hoisting.

Constants should not change so use `const`.

## Arrows
You can replace the `function` keyword with arrows `=>`

old

```js
class TaskCollection {
    constructor( tasks = [] ) {
        this.tasks = tasks;
    }
    log() {
        this.tasks.forEach(function(task) {
            console.log(task)
        })
    }
}
```

new

```js
class TaskCollection {
    constructor( tasks = [] ) {
        this.tasks = tasks;
    }
    log() {
        this.tasks.forEach(task => console.log(task) )
    }
}
```

if you have multiple arguments or none you'll need the paranthesis

```js
class TaskCollection {
    constructor( tasks = [] ) {
        this.tasks = tasks;
    }
    log() {
        this.tasks.forEach((index, task) => console.log(task index) )
    }
}
```

When using arrow syntax `this` refers to the `TaskCollection` not the `Window` object.

You don't have to add return with arrow syntax it is implicit.

```js
let names = ["Jeffrey", "Taylor", "Frank"]

// old
names = names.map(function(name){
    return name + ' is cool.'
})

console.log(names)

// new
names = names.map((name) => name + ' is cool.')

console.log(names)
```

## Default Parameters
ES6 Supports passing in default parameters

```js
// old
function applyDiscount(cost, discount) {
    discount = discount || .10

    return cost - (cost * discount)
}

alert(applyDiscount(100))

// new
function applyDiscount(cost, discount = .10) {
    return cost - (cost * discount)
}

alert(applyDiscount(100))
```

## Crash and Rest
We can use rest aka `...` to say take all the arguments and make them an array.

```js
//old
function sum(...numbers) {
    return numbers.reduce(function(prev, current){
        return prev + current
    })
}
// you can add as many arguments as you want
console.log(sum(1, 2, 6))
````

```js
// new
function sum(...numbers) {
    return numbers.reduce((prev, current) => prev + current)
}

//you can add as many arguments as you want
console.log(sum(1, 2, 6))
```

Spread operator is the opposite of rest and will take an array and make them single arguments.

```js
// spread operator
function sum(x, y) {
    return x + y
}

let nums = [5,10]

//spread operator ...
console.log(sum(...nums))
```

## Template Strings
You can use the backticks to help you create elegant mult-line strings and it supports variable substitution.

```js
//old
let name = 'foo' + 'bar' + 'baz'
```

```js
//new
let name = "Frank"

let template = `
    <div class="ALert">
        <p>${name}</p>
    </div>
`

console.log(template)
```

## Object Shorthand
ES6 includes a wide range of Object additions. In this episode, we'll review three of my favorites: property shorthand, short methods, and object destructuring.

```js
//old
function getPerson() {
    let name = "John"
    let age = 25

    return {
        name: name,
        age: age
    }
}
console.log(getPerson().name );
```

```js
// new
function getPerson() {
    let name = "John"
    let age = 25

    return {name, age}
}

console.log(getPerson().name );
```

Short method syntax in the greet method

```js
// old
 function getPerson() {
     let name = "John"
     let age = 25

     return {
         name,
         age,
         greet: function() {
             return 'Hello ' + this.name
         }
     }
 }


```

```js
// new
function getPerson() {
    let name = "John"
    let age = 25

    return {
        name,
        age,
        greet() {
            return `Hello ${this.name}`
        }
    }
}
```
Object Destructuring allows an object to be broken down into variables

```js
let data = {
    name: 'Karen',
    age: 32,
    results: ['foo', 'bar'],
    count: 30

}

// old
let results = data.results
let count = data.count
console.log(results, count)
```

```js
//new
let { results, count } = data

console.log(results, count)
```

And we can use Object Destructuring in methods as well

```js
// old
function getData(data) {
    var results = data.results
    var count = data.count

    console.log(results, count)
}

getData({
    name: 'Karen',
    age: 32,
    results: ['foo', 'bar'],
    count: 30
})
```

```js
// new
function getData({ results, count }) {
    console.log(results, count)
}

getData({
    name: 'Karen',
    age: 32,
    results: ['foo', 'bar'],
    count: 30
})
```
Another example of Object Destructuring using a person

```js
//old
function greet(person) {
    let name = person.name
    let age = person.age

    console.log('old.Hello, ' + name + '. You are ' + age + ' years old.')
}

greet({
    name: 'Luke',
    age: 32
})
```

```js
//new
function greet({name, age}) {
    console.log(`Hello, ${name}. You are ${age} years old.`)
}

greet({
    name: 'Luke',
    age: 32
})
```

## Classes in ES6
ES6 classes are particularly appealing to those of us who predominantly work in traditional server-side languages.

```js
//old
function User(username, email) {
    this.username = username
    this.email = email

}
User.prototype.changeEmail = function(newEmail){
    this.email = newEmail
}

var user = new User('Frank Pigeon', 'frank@gmail.com')
user.changeEmail('new@gmail.com')

console.dir(user)
```

```js
//new
class User{
    constructor(username, email){
        this.username = username
        this.email = email
    }
    changeEmail(newEmail) {
        this.email = newEmail
    }
}

let frank = new User("Frank Pigeon", "frank@gmail.com")
frank.changeEmail("newemail.com")

console.dir(frank)
```

Static Method example

```js
class User{
    constructor(username, email) {
        this.username = username
        this.email = email
    }
    static register(username, email) {
        return new User(username, email)
    }
    changeEmail(newEmail) {
        this.email = newEmail
    }
}

let frank = User.register("Frank Pigeon", "frank@gmail.com")

console.dir(frank)
```

We can refactor to add the spread operator `...` and add a getter method

```js
class User{
    constructor(username, email) {
        this.username = username
        this.email = email
    }
    static register(...args) {
        return new User(...args)
    }
    // getter
    get foo(){
        return 'foo'
    }
    changeEmail(newEmail) {
        this.email = newEmail
    }
}

let frank = User.register("Frank Pigeon", "frank@gmail.com")

console.log(frank.foo)
```

Another Class example passed thru as function agruments

```js
function log(strategy) {
    strategy.handle()
}

class ConsoleLogger {
    handle() {
        console.log('using console strategy to log.')
    }
}

log(new ConsoleLogger)
```

## Modules
Organizing JavaScript for large projects in 2005 was a bit of a nightmare. It wasn't abnormal to find twenty different script imports in an HTML file. And, worse, it was up to you, the developer, to understand and remember the order to which each of your scripts must be imported. To say it was all a dependency nightmare is an understatement. Luckily, in recent years, modules have come to the rescue!

So first we add a new file in the same directory called `TaskCollection.js`. The contents of this module will be. Notice that we are exporting the class via `export` command.

```js
export class TaskCollection {
    constructor(tasks = []) {
        this.tasks = tasks
    }
    dump() {
        console.log(this.tasks)
    }
}

// we can export many other things too like
export let foo = 'bar'
```

Next back in our main js file `app.js` we can import the module like using the `import` command

```js
import { TaskCollection, foo } from './TaskCollection'

new TaskCollection([
    'go to the store',
    'finish screen cast',
    'eat cake'
]).dump()

console.log(foo)
```

To clean things up, you can refactor your `TaskCollection.js` by adding the export at the bottom of the class.

```js
class TaskCollection {
    constructor(tasks = []) {
        this.tasks = tasks
    }
    dump() {
        console.log(this.tasks)
    }
}

export default TaskCollection
```

and then import it like this. Notice that you don't need the `{}` when you export it via `default`

```js
import TaskCollection from './TaskCollection'
```

## Webpack
But, now, let's switch over to Webpack, which has a much larger community and plugin ecosystem. We'll set up a Webpack config file, transpile ES2015, and even peek at Laravel Elixir 6.0's seamless Webpack integration.

## Promise
A holding spot for an operation that has yet not taken place.

```js
var promise = $this.http.get('some/path');

promise.then(function(data) { //success

});

promise.catch(function(err) { // error

});
```

Promise Makeup

```js
var timer = new Promise(function(resolve, reject) {
    console.log('init promise')
    setTimeout(function() {
        console.log('timeout done')
        resolve()
    }, 5000)
});
timer.then(function() {
    console.log('proceed now that timer has finished')
})
```

## String Additions
String Addition examples

```js
let title = 'Red Rising'

if (title.includes('Red') ) { //checks entire string
    console.log(`${title} includes Red`)
}

if (title.startsWith('Red') ) { //checks beginning of string
    console.log(`${title} starts with Red`)
}

if (title.endsWith('ing') ) { //checks the end of string
    console.log(`${title} ends with ing`)
}

console.log(title.repeat(100))
```

## Array Find and Array includes
```js
console.log(
    // logs boolean if includes 8 in the array
    [2, 4, 6, 8, 10].includes(8) //true
)

console.log(
    // logs odd number in array
    [2, 4, 6, 8, 10, 11].find(item => item % 2 ) //11
)
```

```js
class User {
    constructor(name, isAdmin = false) {
        this.name = name
        this.isAdmin = isAdmin
    }

}

let users = [
    new User('Frank', false),
    new User('Jeffrey', true),
    new User('Jack')
]
//log first user's name that is an admin
console.log(
    users.find(user => user.isAdmin).name
)
```

[1]: https://laracasts.com/series/es6-cliffsnotes/