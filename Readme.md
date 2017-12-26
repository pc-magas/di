## Sample Depedency Injection System

In order to work please create the following json:

```json
{
	"service1":{
		class: ^namespace for the class^
		depedencies:[^name for the first service^,^name for the second service^,...,^name for the nth service^]
	},
	.
	.
	.		
	"service_n":
	{
		class: ^namespace for the class^
		depedencies:[^name for the first service^,^name for the second service^,...,^name for the nth service^]
	}
}
```

Into a file.

Then to use it please use:

```php
use DI\Container;
Resolver r= new DIResolver('^path of the json file^');
```
