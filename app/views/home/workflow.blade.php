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
                    <h3 class='text-center'>行李运送流程</h3>
                    <div style='line-height:30px;'>悦行网 www.yuexingtrip.com，秉承IATA
(International AirTransport Association国际航空运输协会)提出的SPT（Simplifying Passenger Travel）
航空旅行简便化计划，即为航空旅客提供简化登机和行李处理手续的计划，让您充分利用您的假期和商务时间，
远离行李的负担。为减少旅客随身行李丢失，迟运和被错运，我们倡导“徒手旅行计划”，把行李从旅客家里取走送到机场，
旅客就可以作到徒手旅行。同时我们也提供机场至目的地的运送服务，只需在线下单，我们将会在机场领取您的行李并送达
至指定的酒店或其他场所，交付地点是机场范围100公里内的任意地点。我们与众多航空公司、旅行社、在线旅行商、酒店和
度假胜地均有良好的合作，在广州已接受运送的行李超过10万件。现在，快来悦行网体验吧！</div>
                    <div class='m-t-20'>
                        <p><strong>1、</strong>在网上自助下单，点击“开始预订”后填写您的相关信息，或者通过电话向网站客服人员下单。</p>
                        <p><strong>2、</strong>如果您的行李是从机场运送至目的地，航班落地后，我们的配送员将第一时间联系您，并在机场到达厅接收您的行李，填写托运单据。</p>
                        <p><strong>3、</strong>如果您的行李是从住宅、酒店、或者商业大厦等地点运送至机场，请在您的航班起飞前至少6小时下单，我们的配送员将上门收取行李，并在航班起飞前1.5小时将您的行李运送至机场，以便您领取。</p>
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
