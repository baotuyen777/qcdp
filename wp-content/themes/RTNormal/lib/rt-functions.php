<?php

function gtid_get_option($key) {
	return genesis_get_option($key, RT_SETTINGS_FIELD);
}

function gtid_option($key) {
	genesis_option($key, RT_SETTINGS_FIELD);
}

?>