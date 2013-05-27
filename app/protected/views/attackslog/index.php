<?php
/* @var $this AttacksLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Мониторинг атак'
);

$this->menu=array()
?>
<!--menu-->
<div class="row">
    <div class="span12">
        <!-- menu -->
        <nav>
            <ul class="nav nav-tabs">
                <li class="active">
                    <?php
                    echo CHtml::link(
                        'Информация по системе',
                        array(
                            '#',
                        )
                    );
                    ?>
                </li>
            </ul>
        </nav>
    </div>
</div>

<h3>Отслеживаемые атаки</h3>
<label>CSRF</label><input type='checkbox' value='1'  checked = "checked"> <br>
<label>XSS</label><input type='checkbox' value='1'  checked = "checked"> <br>
<label>Brute Force</label><input type='checkbox' value='1'  checked = "checked"> <br> <br>
<input type='submit' value='Сохранить' class='btn btn-info btn-block' style="width:100px"> <br>
<br>

<h3>Мониторинг атак</h3>

</br>

 <label>Период анализа</label>;
 <input type='date' id='dateStart' class='span4' placeholder='01-05-2013'> &nbsp
 <input type='date' id='dateEnd' class='span4' placeholder='09-05-2013'>
<?php
    echo "<br/>";
	echo "<label>Тип атаки</label>";
	echo "<select> 
		<option selected>CSRF</option>
		<option selected>XSS</option>
		<option selected>Brute Force</option>
	</select>";
	echo "<br/>";
?>
    <input type='submit' value='Показать активность' class='btn btn-info btn-block' style="width:250px"> <br>

<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => array(
        'title' => array('text' => 'Динамика атак на сайт'),
        'xAxis' => array(
            'categories' => array('01.05.2013','02.05.2013','03.05.2013', '04.05.2013', '05.05.2013','06.05.2013','07.05.2013','08.05.2013','09.05.2013')
        ),
        'yAxis' => array(
            'title' => array('text' => 'Количество атак')
        ),
        'series' => array(
            array('name' => 'Общее количество атак', 'data' => array(5, 3, 4, 7, 10, 5, 3, 0, 0)),
            array('name' => 'Количество CSRF', 'data' => array(1, 2, 2, 3, 5, 2, 1, 0, 0))
        )
    )
));

$this->Widget('ext.highcharts.HighchartsWidget',array(
        'options' => array(
				'title' => array('text'=>'Процент зафиксированных атак'),
                'series' => array(array(
                        'type' => 'pie',
                        'data' => array(
                                array('CSRF', 63.2),
                                array('XSS', 26.8),
                                array('Brute Force', 10),
                        )
                ))
        )
));
?>


<?php $this->widget('zii.widgets.grid.CGridView',
    array(
        'id'=>'travel-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            'date',
            'type',
            'ip',
            'referer',
            'user_agent',
            /*
            'private',
            */
        ),
        )
    );
?>