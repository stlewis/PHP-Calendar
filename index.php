<style>

  #calendar_wrapper{
    width: 700px;
    height: 500px;
  }
  #calendar_header{
    font-weight: bold;
    clear: both;
  }
  
  #days_box{
    clear: both;
  }
  
  #month_name{
    color: green;
    font-size: 24px;
  }
  
  #day_runner{
    clear: both;
  }
  
  .day_name{
    float: left;
    padding: 5px;
    margin: 2px;
    width: 80px;
  }
  
  .date_box{
    float: left;
    width: 90px;
    height: 90px;
    border: 1px solid black;
  }

  .current_day{
    background-color: #e8d2b0;
  }
  
  .empty_date{
    background-color: gray;
  }
</style>

<?php require 'calendar.php'; ?>

<? $calendar = new Calendar(); ?>

<?= $calendar->render(strftime("%m"), strftime("%Y")); ?>