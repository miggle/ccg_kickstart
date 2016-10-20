# ccg_kickstart
The install profile for NHS CCGs to build sites with.
This is a composer managed install profile.

To install this profile it is suggested you use the CCG Kickstart installer which you
can get by running:
```
$ git clone git@github.com:miggle/ccg_kickstart_installer.git
```
Go into the installer directory:
```
$ cd ccg_kickstart_installer
```
Then you can simply run the following to build the site code-base for the CCG Kickstart distribution:
```
$ composer create-project miggle/ccg_kickstart_installer MY_PROJECT --no-interaction
```
Composer will create a new directory called MY_PROJECT containing a ```docroot``` 
directory with a full CCG Kickstart code base therein.
You can then install it like you would any other Drupal site.