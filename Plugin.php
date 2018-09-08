<?php 
/**
 * 模仿ACFUN通知条公告
 * 
 * @package WTS
 * @author 阿硕
 * @version 1.0.0
 * @link https://www.sshuo.cc
 */
class WTS_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate(){
        Typecho_Plugin::factory('Widget_Archive')->footer = array('WTS_Plugin', 'footer');
        Typecho_Plugin::factory('Widget_Archive') ->header = array('WTS_Plugin', 'header');
    	return'启用成功！请设置您的标题和内容';
    }
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
    	return'禁用成功！插件已经停用';
    }

    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){
    	$title = new Typecho_Widget_Helper_Form_Element_Text('title', null, '公告标题', _t('请输入标题'), '这里填写弹出框的标题');
        $form->addInput($title);
        $text = new Typecho_Widget_Helper_Form_Element_Text('text', null, '公告内容', _t('请输入内容'), '这里填写弹出框的内容');
        $form->addInput($text);
        
    }

    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){
    	
      
    }

    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function render(){}
    public static function header(){
        echo '<link rel="stylesheet" type="text/css" href= "usr/plugins/WTS/notify2.css" />';
    }


    public static function footer(){
     $config = Typecho_Widget::widget('Widget_Options')->plugin('WTS');
        
        $title = Typecho_Widget::widget('Widget_Options') -> Plugin('WTS') -> title;
        $text = Typecho_Widget::widget('Widget_Options') -> Plugin('WTS') -> text;
        $mobile = Typecho_Widget::widget('Widget_Options') -> Plugin('WTS') -> mobile;
        
    
        
        echo '<script src='.'"usr/plugins/WTS'.'/'."zi_message2.js" .'" type="text/javascript" charset="utf-8"></script>';
        echo <<<EOF

<script>
        function OnBtnClick(type) {
            var content = {
                title: "$title" ,
                content: "$text"
            };
            zi_notify.showNotify(type, content);
        }
       
    </script>
    
    <script type = "text/javascript">
        window.onload = function()
        {
            OnBtnClick("$mobile");
        }
    </script>

EOF;
    }
}

    
?>