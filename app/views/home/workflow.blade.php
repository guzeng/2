@extends('home.layout')

@section('content')
<div class="main">
    <div class="container">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo asset('')?>">
                    <?php echo Lang::get('text.homepage')?>
                </a>
            </li>
            <li>
                <a href="<?php echo asset('workflow')?>">
                    <?php echo Lang::get('text.ship_process')?>
                </a>
            </li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <div class="content-page">
              <div class="row">
                <!-- BEGIN LEFT SIDEBAR -->            
                <div class="col-md-9 col-sm-9 blog-posts">
                    <h3 class='text-center'><?php echo App::getLocale()=='zh' ? '行李运送流程' : 'luggage transport process';?></h3>
                    <div class='m-t-50'>
                        <p><strong>1. </strong>
                            <?if(App::getLocale()=='zh'):?>
                            在网上自助下单，点击“开始预订”后填写您的相关信息，或者通过电话向网站客服人员下单。
                            <?else:?>
                            At online self-help order, click on "Order" and fill in your information, or order by phoning the on line customer service staff.
                            <?endif;?>
                        </p>
                        <p><strong>2. </strong>
                            <?if(App::getLocale()=='zh'):?>
                            如果您的行李是从机场运送至目的地，航班落地后，我们的配送员将第一时间联系您，并在机场到达厅接收您的行李，填写托运单据。
                            <?else:?>
                            If your luggage is transported from airport to the destination, after the flight lands, our deliveryman will contact you the first time, receives your luggage at the airport arrival hall, and fill in the shipping documents.
                            <?endif;?>
                        </p>
                        <p><strong>3. </strong>
                            <?if(App::getLocale()=='zh'):?>
                            如果您的行李是从住宅、酒店、或者商业大厦等地点运送至机场，请在您的航班起飞前至少6小时下单，我们的配送员将上门收取行李，并在航班起飞前1.5小时将您的行李运送至机场，以便您领取。
                            <?else:?>
                            If your luggage is carried from places such as residence, hotel, or commercial building, to the airport, please drop the order at least 6 hours before your departure, our deliveryman will collect luggage from door to door, and get back luggage which is carried to the departure hall 1.5 hourse before flight departs.
                            <?endif;?>
                        </p>
                    </div>
                </div>
                <!-- END LEFT SIDEBAR -->
                <!-- BEGIN RIGHT SIDEBAR -->            
                <div class="col-md-3 col-sm-3 blog-sidebar">
                    <?php echo $right?>
                </div>
                <!-- END RIGHT SIDEBAR -->          
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
@stop
