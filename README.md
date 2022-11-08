# __nhcouncils WordPress Theme__

## _️NOTE_
Councils that have v1.3 and earlier of the councils theme for WordPress won't be able to receive theme update notification for the councils theme due to the elimination of Gitlab as software repo.
The following instructions will allow councils to update functions.php in order for councils to get the latest theme update. Editing the "functions.php" file in the theme folder will be needed. 

If you have direct access to the website files, the file is located at:
__/wp-content/themes/bsa-council-theme/functions.php__

It can also be accessed from the WordPress Dashboard
__Dashboard -> Appearance -> Theme Editor and select "Theme Functions (functions.php)"__
&nbsp;
---
MAKE A BACKUP COPY OF FUNCTIONS.PHP 
AND PUT IT SOMEWHERE SAFE BEFORE DOING ANYTHING ELSE.
---

### 1. Find (should be at Line 204):

```php
$published_theme_style = download_url('https://idg1910.githost.io/api/v4/projects/225/repository/files/style.css/raw?private_token=tkz7s95jr1mkEezW1zQY&ref=master');
```
Replace with:
```php
$published_theme_style = download_url('https://www.scouting.org/bsabase/releases/style.css');
```
---
DID YOU MAKE A BACKUP COPY OF FUNCTIONS.PHP 
AND PUT IT SOMEWHERE SAFE BEFORE DOING ANYTHING ELSE?
---

### 2. Find (should start at Line 231):
```php
$theme_package = $theme_dir_url . $published_theme_data['Version'] . '.zip/raw' . $private_token;
$theme_url = $theme_dir_url . 'release.html/raw' . $private_token;
```

Replace with:
```php
$theme_package = 'https://scouting.org/bsabase/releases/' . $published_theme_data['Version'] . '/bsa-council-theme.zip';
$theme_url = "https://www.scouting.org/bsabase/releases/" . $published_version . "/release.html";
```
\\testing
