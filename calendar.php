<?php

  class Calendar{
    
    public $months;
    public $month;
    public $year;
    
    public function __construct(){
      $this->months = array('January'  , 'Feburary', 
                     'March'    , 'April', 
                     'May'      , 'June', 
                     'July'     , 'August', 
                     'September', 'October', 
                     'November' , 'December');
    }
    
    public function render($month, $year){
      $this->month = $month - 1;
      $this->year  = $year;
      $month_name = $this->months[$this->month];
      $html = <<<CAL
      <div id='calendar_wrapper'>
        <div id='calendar_header'>
          <div id='month_name'>$month_name $year</div>
          <div id='day_runner'>
            <div class='day_name'>Sunday</div>
            <div class='day_name'>Monday</div>
            <div class='day_name'>Tuesday</div>
            <div class='day_name'>Wednesday</div>
            <div class='day_name'>Thursday</div>
            <div class='day_name'>Friday</div>
            <div class='day_name'>Saturday</div>
          </div>
        </div>
CAL;
      $html .= "<div id='days_box'>".$this->calendar_for($this->month, $this->year)."</div>";
      $html .= "</div>";
      return $html;
    }
    
    public function calendar_for($month, $year){
      $month = $month + 1;
      $num_days   = cal_days_in_month(CAL_GREGORIAN, $month, $year);
      $first_day  = new DateTime("$year-$month-01"); 
      $fd_idx     = $first_day->format('N') == '7' ? 0 : $first_day->format('N');
      $html = "";
      $num  = 1;
      $day_idx = 0;
      for($i = 1; $i <= $num_days + $fd_idx; $i++){
        $day_idx++;
        $day_idx = $day_idx == 7 ? 0 : $day_idx++;
        if($i <= $fd_idx){
          $num = 1;
          $html .= $this->empty_block();
        }else{
          $html .= $this->day_block($num);  
          $num += 1;
        }
      }
      $add_on = 7 - $day_idx;
      for($i = 1; $i <= $add_on; $i++){
        $html .= $this->empty_block();
      }
      return $html;
    }
    
    private function day_block($day_num){
      $month     = $this->month + 1;
      $class     = "date_box";
      $now       = new DateTime(strftime("%Y-%m-%d"));
      $this_date = new DateTime("{$this->year}-{$month}-{$day_num}");
      if($this_date == $now) $class .= " current_day";
      $html  = "<div class='$class'><div class='day_num_box'>$day_num</div></div>";
      return $html;
    }
    
    private function empty_block(){
      $html = "<div class='empty_date date_box'><div class='day_num_box'>&nbsp;</div></div>";
      return $html;
    }
    
  
  }

?>