<?php
declare (strict_types=1);

namespace linxyyl\model\helper;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\facade\Console;
use think\facade\Db;


class ModelFileGenerate extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('modelfilegenerate')
            ->addArgument('namec', Argument::OPTIONAL, '目录名', 'app\linxyyl\model')
            ->setDescription('the modelfilegenerate command');
    }

    protected function execute(Input $input, Output $output)
    {
        // 获取生成目录名
        $namec = $input->getArgument('namec');
        $catalog = 'app/linxyyl';
        if (!is_dir('app/linxyyl')) {
            mkdir($catalog);
        }
        $catalog = 'app/linxyyl/model';
        mkdir($catalog);
        // 指令输出
        $output->writeln('模型文件生成');
        $database_name = env('database.database');
        // 获取数据库表名
        $table_names = array_column(Db::query("show tables from {$database_name}"), 'Tables_in_' . $database_name);
        foreach ($table_names as $table_name) {
            // 获取生成模型名也就是文件名
            $model_name = parse_name(str_replace(env('database.prefix'), '', $table_name), 1);
            // 创建文件
            $file_name = $catalog . '/' . $model_name . '.php';
            touch($file_name);
            $file_obj = fopen($file_name, 'r+');
            fwrite($file_obj, $this->createCode($model_name, $namec));
        }
        //Console::call("model:annotation",["dir linxyyl/model"]);
        exec('php think model:annotation --dir linxyyl/model');
    }


    /**
     * @param $model_name
     * @return string
     */
    private function createCode($model_name, $namebase)
    {
        $str1 = '$model';

        return $code = <<<CODE
<?php
namespace $namebase;

use think\Model;
/**
 * Class $model_name
 * @package {$model_name}\model
 */
class {$model_name} extends Model
{   
     /**
     * 查询后事件
     * @param $str1
     */
	public static function onAfterRead($str1)
    {
    	
    }
    
    /**
     * 新增前事件
     * @param $str1
     */
	public static function onBeforeInsert($str1)
    {
    	
    }
    
     /**
     * 新增后事件
     * @param $str1
     */
	public static function onAfterInsert($str1)
    {
    	
    }
    
     /**
     * 更新前事件
     * @param $str1
     */
	public static function onBeforeUpdate($str1)
    {
    	
    }
    
     /**
     * 更新后事件
     * @param $str1
     */
	public static function onAfterUpdate($str1)
    {
    	
    }
    
     /**
     * 写入前事件
     * @param $str1
     */
	public static function onBeforeWrite($str1)
    {
    	
    }
    
     /**
     * 写入后事件
     * @param $str1
     */
	public static function onAfterWrite($str1)
    {
    	
    }
    
     /**
     * 	删除前事件
     * @param $str1
     */
	public static function onBeforeDelete($str1)
    {
    	
    }
    
    /**
     * 	删除后事件
     * @param $str1
     */
	public static function onAfterDelete($str1)
    {
    	
    }
    
    /**
     * 恢复前事件
     * @param $str1
     */
	public static function onBeforeRestore($str1)
    {
    	
    }
    
    /**
     * 恢复后事件
     * @param $str1
     */
	public static function onAfterRestore($str1)
    {
    	
    }
}

CODE;
    }
}
