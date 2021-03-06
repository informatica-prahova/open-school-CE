<?php 
/**
 * Ajax Crud Administration
 * StudentCategories * index.php view file
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 * @license The MIT License
 */
?><?php
 $this->breadcrumbs=array(
	 'Manage Student Categories'
);
?>
<?php  
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-categories-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<script>
$(document).ready(function() {
$(".s_no_but").click(function(){
	                $('.gridact_drop').hide();
	            
            	if ($("#"+this.id+'l').is(':hidden')){
					$('.ns_drop').hide();
				    $(".s_no_but").removeClass("ns_drop_hand");	
                	$("#"+this.id+'l').show();
					$("#"+this.id).addClass("ns_drop_hand");
					$(".gridact_drop").hide();
					
				}
            	else{
                	$("#"+this.id+'l').hide();
					$("#"+this.id).removeClass("ns_drop_hand");
            	}
            return false;
       			 });
				  $("#"+this.id+'l').click(function(e) {
            		e.stopPropagation();
        			});
        		
});
$(document).click(function() {
					
            		$('.ns_drop').hide();
					$(".s_no_but").removeClass("ns_drop_hand");
					
        			});
</script>

<script>
$(document).ready(function() {
$(".action_but").click(function(){
	                $(".ns_drop").hide();
					$(".s_no_but").removeClass("ns_drop_hand");
	            
				if ($("#"+this.id+'a').is(':hidden')){
					$('.gridact_drop').hide();
					$("#"+this.id+'a').show();
					}
            	else{
                	$("#"+this.id+'a').hide();
					}
            return false;
       			 });
				  $("#"+this.id+'a').click(function(e) {
            		e.stopPropagation();
        			});
        		
});
$(document).click(function() {
					
            		$('.gridact_drop').hide();
					});
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">

<h1><?php echo Yii::t('students','Manage Student Categories');?></h1>

<div class="edit_bttns" style="right:15px; top:12px;">
    <?php 
   $criteria = new CDbCriteria;
	$criteria->order = 'id DESC';
	$total = StudentCategories::model()->count($criteria);
	$pages = new CPagination($total);
	$pages->setPageSize(Yii::app()->params['listPerPage']);
	$pages->applyLimit($criteria);  // the trick is here!
	//$datas = StudentCategories::model()->findAll($criteria);
	$page_size=Yii::app()->params['listPerPage'];
		
   ?>
    <ul>
    <li>
           <?php echo CHtml::link('<span>'. Yii::t('students','Create New Category').'</span>', array('#'),array('id'=>'add_student-categories','class'=>'addbttn last')) ?>
            </li>
    </ul>
    <div class="clear"></div>
   </div><div id="success_flash" align="center" style=" color:#F00; display:none;"><h4>Selected category Deleted Successfully !</h4>
 
   </div>
    </div>
    <?php $datas=StudentCategories::model()->findAll($criteria);?>
    <div id="student-categories-grid">
    <div class="grid_table_con">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="example">
  <tr>
    
    <th width="45%"><?php echo Yii::t('students','Category Name');?><a href="#" class="sort_but"></a></th>
    <th width="16%"><?php echo Yii::t('students','Status');?><a href="#" class="sort_but"></a></th>
    <th width="19%"><?php echo Yii::t('students','No. of Students');?><a href="#" class="sort_but"></a></th>
    <th width="16%"><?php echo Yii::t('students','Actions');?></th>
  </tr>
  <?php if($datas!=NULL)
  {
  foreach($datas as $data)
  { ?>
  <?php $count=Students::model()->findAllByAttributes(array('student_category_id'=>$data->id)); ?>
  <tr>
    
    <td><?php echo $data->name ?></td>
    <?php echo $data->is_deleted ? '<td align="center" ><strong>Inactive' : '<td align="center" style="color:#093"><strong>Active' ?></strong></td>
    <td align="center" class="ns">
    <div style="position:relative" id="d<?php echo $data->id ?>"><span class="s_no"><?php echo count($count) ?><a href="#" class="s_no_but" id="<?php echo $data->id ?>"></a></span>
		  <div class="ns_drop" id="<?php echo $data->id ?>l" style="display:none">
    	<ul>
        	<!--<li><!--<a href="#" class="add">Add Students-<?php echo $data->id ?></a></li>-->
            <li><a href="<?php echo $data->id ?>" class="view">View Students</a></li>
            <!--<li><!--<a href="#" class="fees">Create Fees</a></li>
            <li><!--<a href="#" class="report">Create Report</a></li>-->
        </ul>
    </div>
	</div>
    </td>
    <td align="center" class="act"><div style="position:relative"><span class="action_but" id="<?php echo $data->id ?>"></span>
    	<div class="gridact_drop" id="<?php echo $data->id ?>a">
        	<div class="gridact_arrow"></div>
        	<ul>
            	<!--<li><a href="#" class="grview">View</a></li>-->
                <li><a href="<?php echo $data->id ?>" class="gredit">Edit</a></li>
                <li><a href="<?php echo $data->id ?>" class="grdel">Delete</a></li>
            </ul>
        </div>
    </div>
    </td>
  </tr>
  <?php }}?>
  
</table>

    </div>
    

<?php
//Strings for the delete confirmation dialog.
$del_con = Yii::t('students', 'Are you sure you want to delete this student category?');
$del_title=Yii::t('students', 'Delete Confirmation');
$del=Yii::t('students', 'Delete');
$cancel=Yii::t('students', 'Cancel');
?>
  
<div class="pagecon">
                                                 <?php 
	                                                  $this->widget('CLinkPager', array(
													  'currentPage'=>$pages->getCurrentPage(),
													  'itemCount'=>$total,
													  'pageSize'=>$page_size,
													  'maxButtonCount'=>5,
													  //'nextPageLabel'=>'My text >',
													  'header'=>'',
												  'htmlOptions'=>array('class'=>'pages'),
												  ));?>
                                                  </div>

<?php
    /*$this->widget('zii.widgets.grid.CGridView', array(
         'id' => 'student-categories-grid',
         'dataProvider' => $model->search(),
         'filter' => $model,
		 'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	     'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
         'htmlOptions'=>array('class'=>'grid-view clear'),
          'columns' => array(
          		
		'name',
		
		array(
            'name'=>'is_deleted',
			'header'=>'Status',
			'value'=>'$data->is_deleted ? "Inactive" : "Active"'
        ),
		array(            
            'name'=>'id',
			'header'=>'No. of Students',
            'type'=>'raw', //because of using html-code
			'filter'=>false,
            'value'=>array($this,'links'), //call this controller method for each row
        ),

    array(
                   'class' => 'CButtonColumn',
                    'buttons' => array(
                                                     'student-categories_delete' => array(
                                                     'label' => Yii::t('admin_student-categories', 'Delete'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/cross.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_del", 'title' => Yii::t('admin_student-categories', 'Delete')), // HTML options for the button   tag
                                                      ),
                                                     'student-categories_update' => array(
                                                     'label' => Yii::t('admin_student-categories', 'Update'), // text label of the button
                                                     'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                     'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/pencil.png', // image URL of the button.   If not set or false, a text link is used
                                                     'options' => array("class" => "fan_update", 'title' => Yii::t('admin_student-categories', 'Update')), // HTML options for the    button tag
                                                        ),
                                                     'student-categories_view' => array(
                                                      'label' => Yii::t('admin_student-categories', 'View Students'), // text label of the button
                                                      'url' => '$data->id', // a PHP expression for generating the URL of the button
                                                      //'imageUrl' =>Yii::app()->request->baseUrl .'/js_plugins/ajaxform/images/icons/properties.png', // image URL of the button.   If not set or false, a text link is used
                                                      'options' => array("class" => "fan_view", 'title' => Yii::t('admin_student-categories', 'View')), // HTML options for the    button tag
                                                        )
                                                    ),
                   'template' => '{student-categories_view}{student-categories_update}{student-categories_delete}',
				   'header'=>'Actions',
            ),
    ),
           'afterAjaxUpdate'=>'js:function(id,data){$.bind_crud()}'

                                            ));
*/

   ?>
   </div></td></tr></table>
   

<script type="text/javascript">
//document ready
$(function() {

    //declaring the function that will bind behaviors to the gridview buttons,
    //also applied after an ajax update of the gridview.(see 'afterAjaxUpdate' attribute of gridview).
        $. bind_crud= function(){
            
 //VIEW

    $('.view').each(function(index) {
        var id = $(this).attr('href');
        $(this).bind('click', function() {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=students/studentCategory/returnView",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#student-categories-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#student-categories-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    $.fancybox(data,
                            {    "transitionIn" : "elastic",
                                "transitionOut" :"elastic",
                                "speedIn"              : 600,
                                "speedOut"         : 200,
                                "overlayShow"  : false,
                                "hideOnContentClick": false
                            });//fancybox
                    //  console.log(data);
                } //success
            });//ajax
            return false;
        });
    });

//UPDATE

    $('.gredit').each(function(index) {
        var id = $(this).attr('href');
        $(this).bind('click', function() {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=students/studentCategory/returnForm",
                data:{"update_id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#student-categories-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#student-categories-grid").removeClass("ajax-sending");
                },
                success: function(data) {
                    $.fancybox(data,
                            {    "transitionIn"    :  "elastic",
                                 "transitionOut"  : "elastic",
                                 "speedIn"               : 600,
                                 "speedOut"           : 200,
                                 "overlayShow"    : false,
                                 "hideOnContentClick": false,
                                "afterClose":    function() {window.location.reload();
                                   var page=$("li.selected  > a").text();
                                $.fn.yiiGridView.update('student-categories-grid', {url:'<?php echo Yii::app()->request->getUrl()?>',data:{"StudentCategories_page":page}});
                                }//onclosed
                            });//fancybox
                    //  console.log(data);
                } //success
            });//ajax
            return false;
        });
    });


// DELETE

    var deletes = new Array();
    var dialogs = new Array();
    $('.grdel').each(function(index) {
        var id = $(this).attr('href');
        deletes[id] = function() {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=students/studentCategory/ajax_delete",
                data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                    beforeSend : function() {
                    $("#student-categories-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#student-categories-grid").removeClass("ajax-sending");
                },
                success: function(data) {window.location.reload();
                    var res = jQuery.parseJSON(data);
                     var page=$("li.selected  > a").text();
                    $.fn.yiiGridView.update('student-categories-grid', {url:'<?php echo Yii::app()->request->getUrl()?>',data:{"StudentCategories_page":page}});
                }//success
            });//ajax
        };//end of deletes

        dialogs[id] =
                        $('<div style="text-align:center;"></div>')
                        .html('<p style="color:#000000"><?php echo $del_con;?></p>')
                       .dialog(
                        {
                            autoOpen: false,
                            title: '<?php echo  $del_title; ?>',
                            modal:true,
                            resizable:false,
                            buttons: [
                                {
                                    text: "<?php echo  $del; ?>",
                                    click: function() {
                                                                      deletes[id]();
                                                                      $(this).dialog("close");
																	 $("#success_flash").css("display","block").animate({opacity: 1.0}, 3000).fadeOut("slow");
                                                                      }
                                },
                                {
                                   text: "<?php echo $cancel; ?>",
                                   click: function() {
                                                                     $(this).dialog("close");
                                                                     }
                                }
                            ]
                        }
                );

        $(this).bind('click', function() {
                                                                      dialogs[id].dialog('open');
                                                                       // prevent the default action, e.g., following a link
                                                                      return false;
                                                                     });
    });//each end

        }//bind_crud end

   //apply   $. bind_crud();
  $. bind_crud();


//CREATE 

    $('#add_student-categories ').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=students/studentCategory/returnForm",
            data:{"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#student-categories-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#student-categories-grid").removeClass("ajax-sending");
                },
            success: function(data) {
                $.fancybox(data,
                        {    "transitionIn"      : "elastic",
                            "transitionOut"   : "elastic",
                            "speedIn"                : 600,
                            "speedOut"            : 200,
                            "overlayShow"     : false,
                            "hideOnContentClick": false,
                            "afterClose":    function() {window.location.reload();} //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind


})//document ready
    
</script>
 