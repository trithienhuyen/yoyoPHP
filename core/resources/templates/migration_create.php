&lt;?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
namespace Entity;
class <?php echo $migration_name; ?> extends \Spot\Entity
{
    protected static $table = '';
    public static function fields()
    {
        return [
            'id'           => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'date_created' => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }
}