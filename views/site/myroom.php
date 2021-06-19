<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$this->title = 'Кабінет';
$this->params['breadcrumbs'][] = $this->title;
?>

<script>

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://e-osvita.online/api/index', true);

    xhr.onload = function () {
        alert(this.responseText);
    };

    xhr.send(null);




</script>

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">

            <div class="col-6 col-sm-6 col-lg-4">
                <h4>Рекламный блок</h4>

            </div><!--/span-->
          <div class="jumbotron">
            <h1>Hello, world!</h1>
            <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
          </div>

            <div class="col-6 col-sm-6 col-lg-4">

                <h4>Рекламный блок</h4>
            </div><!--/span-->


        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
            <a href="#" class="list-group-item active">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
          </div>
            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">&nbsp;&nbsp;&nbsp;&nbsp;Ваше расписание&nbsp;&nbsp;&nbsp;
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <form>
                                <script></script>
                                <div class="form-group">
                                    <label for="inputDate">Выбери дату:</label>
                                    <input type="date" class="form-control" onchange="Alert();">
                                </div>
                            </form>
                        </ul>
                    </div>

                    <button type="button" class="btn btn-warning">&nbsp;&nbsp;Добавить расписание&nbsp;</button>
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown">Изменить расписание
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <form>
                                <script></script>
                                <div class="form-group">
                                    <label for="inputDate">Выбери дату:</label>
                                    <input type="date" class="form-control" onchange="Alert();">
                                </div>
                            </form>
                        </ul>
                    </div>



                </div>
            </div><!--/span-->
        </div><!--/row-->
        </div><!--/span-->



   </div>
