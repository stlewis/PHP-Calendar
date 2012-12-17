<?php

  class Calendar{
    
    public $months;
    public $month;
    public $year;
    public $calendar_width;
    
    public function __construct($month = null, $year = null, $calendar_width = 500){
      $this->month = $month;
      $this->year  = $year;
      $this->calendar_width = $calendar_width;
      $this->months = array('January'  , 'Feburary', 
                     'March'    , 'April', 
                     'May'      , 'June', 
                     'July'     , 'August', 
                     'September', 'October', 
                     'November' , 'December');
    }
    
    public function render($month = null, $year = null){
      $this->month = $this->month ? $this->month : $month;
      $this->year  = $this->year ? $this->year : $year;
      $month_name = $this->months[$this->month - 1];
      $calendar_width_style = $this->calendar_width ? "width: {$this->calendar_width}px;" : "";
      $box_width_style = $this->calendar_width ? "width: ".$this->calculate_box_width()."px;" : "";      
      $html = <<<CAL
      <div id='calendar_wrapper' style="$calendar_width_style">
        <div id='calendar_header' style='clear: both;'>
          <div id='month_name'>$month_name {$this->year}</div>
          <div id='day_runner' style='clear: both;'>
            <div style='float: left; $box_width_style text-align: center;' class='day_name'>SUN</div>
            <div style='float: left; $box_width_style text-align: center;' class='day_name'>MON</div>
            <div style='float: left; $box_width_style text-align: center;' class='day_name'>TUE</div>
            <div style='float: left; $box_width_style text-align: center;' class='day_name'>WED</div>
            <div style='float: left; $box_width_style text-align: center;' class='day_name'>THU</div>
            <div style='float: left; $box_width_style text-align: center;' class='day_name'>FRI</div>
            <div style='float: left; $box_width_style text-align: center;' class='day_name'>SAT</div>
          </div>
        </div>
CAL;
      $html .= "<div id='days_box' style='clear:both;'>".$this->calendar_for($this->month, $this->year)."</div>";
      $html .= "</div>";
      return $html;
    }
    
    public function calendar_for($month, $year){
      // $month = $month + 1;
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
      $month     = $this->month;
      $class     = "real_date date_box";
      $now       = new DateTime(strftime("%Y-%m-%d"));
      $this_date = new DateTime("{$this->year}-{$month}-{$day_num}");
      $id_date   = strftime("%Y-%m-%d", strtotime("{$this->year}-{$month}-{$day_num}"));
      if($this_date == $now) $class .= " current_day";
      $box_width_style = $this->calendar_width ? $this->calculate_box_width()."px;" : "";      
      $html  = "<div class='$class' id='date_{$id_date}' style='float: left; width: {$box_width_style}; height: {$box_width_style};'><div class='day_num_box'>$day_num</div></div>";
      return $html;
    }
    
    private function empty_block(){
      $box_width_style = $this->calendar_width ? $this->calculate_box_width()."px" : "";      
      $html = "<div class='empty_date date_box' style='float: left; ; width: {$box_width_style}; height: {$box_width_style}'><div class='day_num_box'>&nbsp;</div></div>";
      return $html;
    }

    private function calculate_box_width(){
      return ($this->calendar_width/7) - 2;
    }
    
  
  }

?>
