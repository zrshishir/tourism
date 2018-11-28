<?php 

//varsion check
if (version_compare(PHP_VERSION, '7.1', '<')) {
    echo 'Your php version : ' . PHP_VERSION . " <br>To run this script php version has to be 7.1";
}


// check checkExtensions
function checkExtensions() 
    {
        $checkResults = [];

        // extension information
        $extensions = array(
            array('name' => 'fileinfo', 'type' => 'extension', 'expected' => true, 'link' => 'http://php.net/manual/en/book.fileinfo.php'),
            array('name' => 'mbstring', 'type' => 'extension', 'expected' => true, 'link' => 'http://php.net/manual/en/book.mbstring.php'),
            array('name' => 'pdo', 'type' => 'extension', 'expected' => true, 'link' => 'http://php.net/manual/en/book.pdo.php'),
            array('name' => 'pdo_mysql', 'type' => 'extension', 'expected' => true, 'link' => 'http://php.net/manual/en/ref.pdo-mysql.php'),
            array('name' => 'gd', 'type' => 'extension', 'expected' => true, 'link' => 'http://php.net/manual/en/book.image.php'),
            array('name' => 'Mcrypt', 'type' => 'extension', 'expected' => true, 'link' => 'http://php.net/manual/en/book.mcrypt.php'),
            array('name' => 'mysql_real_escape_string', 'type' => 'extension', 'expected' => false, 'link' => 'http://php.net/manual/en/function.mysql-real-escape-string.php'),
            array('name' => 'curl', 'type' => 'extension', 'expected' => true, 'link' => 'http://php.net/manual/en/book.curl.php'),
        );

        $problem = false;

        foreach ($extensions as &$ext) {
            if ($ext['type'] === 'function') { // if extension type is function
                $loaded = function_exists($ext['name']);
            } else { //
                $loaded = extension_loaded($ext['name']);
            }
            // if doesn't match the requirement
            if ($loaded !== $ext['expected']) {
                $problem = true;
            }

            $ext['actual'] = $loaded;
        }

        $checkResults['extensions'] = $extensions;
        $checkResults['extensions_problem'] = $problem;

        echo '<pre>';
        print_r($checkResults);
        return true;
    }

checkExtensions();

?>