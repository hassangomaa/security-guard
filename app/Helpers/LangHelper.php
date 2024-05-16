<?php

// app/Helpers/LangHelper.php



if (! function_exists('lang')) {
function lang($name, $locale = null)
{
if ($locale === null) {
$locale = app()->getLocale();
}

$fieldName = 'name_' . $locale;

if (isset($name->$fieldName)) {
return $name->$fieldName;
}

return null;
}
}
