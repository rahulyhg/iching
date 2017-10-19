<?php
class Loadini {

    /**
     * Namespace for my settings in the ini file
     */
    const INI_NAMESPACE = "iching";

    /**
     * Creates a MySQLi instance using the settings from ini files
     *
     * @param   string  $group  The group of settings to load.
     * @return  object
     *
     */
    public static function init($group) {
        static $dbs = array();
        if (!is_string($group)) {
            throw new Exception("Invalid group requested");
        }
        if (empty($dbs["group"])) {
            $prefix = MyDB::INI_NAMESPACE . ".$group";
            $root = get_cfg_var("$prefix.root");
        }
        return (array('root' => $root));
    }

}

?>
