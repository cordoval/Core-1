<?php

function map_config($server = 'de92.die-staemme.de')
{
        $file          = file_get_contents("http://".$server."/interface.php?func=get_building_info");
        $config        = simplexml_load_string($file);
        $config_mapper = array(
                'wood'=>'costs.Wood.value',
                'stone'=>'costs.Stone.value',
                'iron'=>'costs.Iron.value',
                'pop'=>'consumptions.Population.value',
                'wood_factor'=>'costs.Wood.factor',
                'stone_factor'=>'costs.Stone.factor',
                'iron_factor'=>'costs.Iron.factor',
                'pop_factor'=>'consumptions.Population.factor',
                'min_level'=>'levels.minimum',
                'max_level'=>'levels.maximum',
                'build_time'=>'build.time',
                'build_time_factor'=>'build.factor',
                'requirements'=>'requirements'
        );

        $building_types = array(
                'Main'=>'Base',
                'Barracks'=>'Production\Unit',
                'Stable'=>'Production\Unit',
                'Garage'=>'Production\Unit',
                'Church'=>'Base',
                'Church_f'=>'Base',
                'Snob'=>'Production\Unit',
                'Smith'=>'Research',
                'Place'=>'Base',
                'Statue'=>'Base',
                'Market'=>'Market',
                'Wood'=>'Production\Resource',
                'Iron'=>'Production\Resource',
                'Stone'=>'Production\Resource',
                'Farm'=>'Consumer',
                'Storage'=>'Storage',
                'Hide'=>'Base',
                'Wall'=>'Base',
        );




        $tech_tree = array(
                'Main'=>array(),
                'Wood'=>array(),
                'Stone'=>array(),
                'Iron'=>array(),
                'Farm'=>array(),
                'Storage'=>array(),
                'Statue'=>array(),
                'Hide'=>array(),
                'Place'=>array(),
                'Church_f'=>array(),
                'Barracks'=>array(
                        'Main'=>3
                ),
                'Stable'=>array(
                        'Main'=>10,
                        'Barracks'=>5,
                        'Smith'=>5
                ),
                'Church'=>array(
                        'Main'=>5,
                        'Farm'=>5
                ),
                'Smith'=>array(
                        'Main'=>5,
                        'Barracks'=>1
                ),
                'Market'=>array(
                        'Main'=>3,
                        'Storage'=>2
                ),
                'Garage'=>array(
                        'Main'=>10,
                        'Smith'=>10
                ),
                'Wall'=>array(
                        'Barracks'=>1
                ),
                'Snob'=>array(
                        'Main'=>20,
                        'Smith'=>20,
                        'Market'=>10
                ),
        );
        $detail_settings = array(
                'Storage.Storage.capacity'=>array(
                                'value'=>1000,
                                'factor'=>1.229
                ),
                'Consumer.Farm.capacity'=>array(
                        
                                'value'=>240,
                                'factor'=>1.17
                )
        );

        $config_result = array();
        foreach ($config as $buildng_name=> $values)
        {
                $buildng_name = ucfirst($buildng_name);
                $arr          = array_merge(
                (array) $values, array('requirements'=>$tech_tree[$buildng_name])
                );
                foreach ($arr as $name=> $value)
                {
                        $path = $building_types[$buildng_name].'.'.$buildng_name.'.'.$config_mapper[$name];


                        set_path($config_result, $path, $value);
                }

                foreach ($detail_settings as $path=> $value)
                {

                        set_path($config_result, $path, $value);
                }
        }
        echo '<pre>'.print_r($config_result, true).'</pre>';
         file_put_contents('settings/buildings.php', '<?php return '.var_export($config_result, true).';');
}

function set_path(& $array, $path, $value, $delimiter = '.')
{



        $keys = explode($delimiter, $path);


        while (count($keys) > 1)
        {
                $key = array_shift($keys);

                if (ctype_digit($key))
                {
                        // Make the key an integer
                        $key = (int) $key;
                }

                if (!isset($array[$key]))
                {
                        $array[$key] = array();
                }

                $array = & $array[$key];
        }

        $array[array_shift($keys)] = $value;
}

map_config();