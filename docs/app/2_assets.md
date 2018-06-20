# Assets

All the `javascript` and `scss` assets are in the `ressource/assets` folder.

These assets needs to be compiled in the public folder, laravel-mix provide an easy way to do all the job.

All the tasks are defined in the `webpack.mix.js` file.
If you want to add new files to the mix asset pipeline, you can easily add it in this config file, see the doc for info's.

```sh
# Run all the mix tasks (transpile, compile and generate maps in the public folder)
npm run dev # yarn dev

# Run all the mix tasks for production (traspile, compile and minify output)
npm run prod # yarn production

# You can compile on the fly (file change, helpful for development)
npm run watch # yarn watch
```

**NOTE** if you use shared folders (typically between windows and our vagrant machine)
the watch command is unable to detect file changes if you make the changes on the other system than the one on which the command is executed.

<br>
<br>
<br>
<hr>

**Helpful links :**

* [Laravel-mix docs](https://laravel.com/docs/5.6/mix)
* [Yarn](https://yarnpkg.com/en/)

<hr>
<div align="center">

**[<- Prev](./1_migrationAndSeeding.md) // [Summary](../README.md) // [Next ->](./3_architecture.md)**

</div>