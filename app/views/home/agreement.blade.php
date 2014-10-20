@extends('home.layout')

@section('content')
<div class="main">
    <div class="container p-20">
        <?php if(App::getLocale()=='zh'):?>
        <div class='text-center m-b-20'>
            <h2>会员注册协议</h2>
        </div>
        <p><strong>第一条　会员资格</strong></p>
        <p>在您承诺完全同意本服务条款并在悦行网完成注册程序后，即可成为本网站会员，享受悦行网为您提供的服务。</p>
        <p><strong>第二条　会员权限</strong></p>
        <p>1、会员能享有本网站提供的服务，可参阅会员服务内容；</p>
        <p>2、任何会员均有义务遵守本规定及其它网络服务的协议、规定、程序及惯例。</p>
        <p><strong>第三条　会员资料</strong></p>
        <p>1、为了使我们能够更好地为会员提供服务，请您提供详尽准确的个人资料，如更改请及时更新，提供虚假资料所造成的后果由会员承担；</p>
        <p>2、会员有责任保管好自己的注册密码并定期修改避免造成损失，由于会员疏忽所造成的损失由会员承担。会员应当对以其用户账户进行的所有活动和事件负法律责任。</p>
        <p><strong>第四条　会员资格的取消</strong></p>
        <p>如发现任何会员有以下故意行为之一，本网站保留取消其使用服务的权利，并无需做出任何补偿；</p>
        <p>1、可能造成本网站全部或局部的服务受影响，或危害本网站运行；</p>
        <p>2、以任何欺诈行为获得会员资格；</p>
        <p>3、在本网站内从事非法商业行为，发布涉及敏感政治、宗教、色情或其它违反有关国家法律和政府法规的文字、图片等信息；</p>
        <p>4、以任何非法目的而使用网络服务系统；</p>
        <p><strong>第五条　悦行网的权利</strong></p>
        <p>1、有权审核、接受或拒绝会员的入会申请，有权撤销或停止会员的全部或部分服务内容；</p>
        <p>2、有权修订会员的权利和义务，有权修改或调整本网站的服务内容；</p>
        <p>3、有权将修订的会员的权利和义务以E-mail形式通知会员，会员收到通知后仍继续使用本网站服务者即表示会员同意并遵守新修订内容。</p>
        <p>4、本网站提供的服务仅供会员独立使用，未经本网站授权，会员不得将会员号授予或转移给第三方。会员如果有违此例，本网站有权向客户追索商业损失并保留追究法律责任的权利。</p>
        <p><strong>第六条　悦行网的义务</strong></p>
        <p>1、认真做好本网站所涉及的网络及通信系统的技术维护工作，保证本网站的畅通和高效；</p>
        <p>2、除不可抗拒的因素导致本网站临时停止或短时间停止服务以外，如本网站需停止全部或部分服务时，将提前在本网站上发布通知通告会员。</p>
        <p>3、如本网站因系统维护或升级等原因需暂停服务，将事先通过主页、电子邮件等方式公告会员；</p>
        <p>4、因不可抗力而使本网站服务暂停，所导致会员任何实际或潜在的损失，本网站不做任何补偿；</p>
        <p>5、本网站不承担会员因遗失密码而受到的一切损失。</p>
        <p>6、本网站仅提供相关的网络服务，除此之外与相关网络服务有关的设备（如电脑、调制解调器及其他与接入互联网有关的装置）及所需的费用（如为接入互联网而支付的电话费及上网费）均应由会员自行负担。</p>
        <p><strong>第七条　附则</strong></p>
        <p>1、以上规定的范围仅限于悦行网；</p>
        <p>2、本网站会员因违反以上规定而触犯有关法律法规，一切后果自负，本网站不承担任何责任；</p>
        <p>3、本规则未涉及之问题参见有关法律法规，当本规定与有关法律法规冲突时，以相应的法律法规为准。在本条款规定范围内，悦行网拥有最终解释权。</p>
        <?php else:?>
        <div class='text-center m-b-20'>
            <h2>Registration agreement</h2>
        </div>
        <p><strong>1. Membership</strong></p>
        <p>After you completely agree with the service terms and complete the registration at Yuexingtrip.com, you can be a member and enjoy the service Yuexingtrip.com provides.</p>
        <p><strong>2. Membership privileges</strong></p>
        <p>a. Member can enjoy services provided by this website, which can be referred to the member service content.</p>
        <p>b. Any members are obligated to comply with this regulation and other network services agreement, regulations, procedures and practices.</p>
        <p><strong>3. Membership information</strong></p>
        <p>a. In order to enable us to provide better service for members, please provide detailed and accurate personal information. If there’s any change, please update in time. The consequences of providing false information shall be borne by the members.</p>
        <p>b. Registered members have the responsibility to keep your password and change on a regular time to avoid losses.If members lose the password carelessly,.losses shall be borne by the member. Members should take all the legal responsibility for the activities and events with their accounts.</p>
        <p><strong>4. The cancellation of the membership</strong></p>
        <p>If one of the following intentional action was found by any member, we reserve the right to cancel the use of the service, and do not need to make any compensation:</p>
        <p>a. May affected the partial or all of the website services, or harm to the web site operation.</p>
        <p>b. Any fraud to obtain membership.</p>
        <p>c. Engaged in the illegal commercial behavior, involving sensitive politics, religion, sex or other violation of relevant state laws and government regulations of words, pictures and other information through this website.</p>
        <p>d. For any illegal purposes by using the network service system.</p>
        <p><strong>5. Rights of Yuexingtrip.com</strong></p>
        <p>a. Entitled to review and accept or reject the member's application for membership, and shall have the right to cancel or to stop all or part of the service content.</p>
        <p>b. Eligibleto revise the rights and obligations of members and modify the service content of this website.</p>
        <p>c. Have the right to revise the member's rights and obligations to inform members by E-mail. It indicates that members agree to abide by the new revised content if members continue to use service of this website after receiving the notification.</p>
        <p>d. This website provides services only for personal use of members. Members are not allowed transfer the account to a third party without authorization. This website reserves the right to claim losses to the members and reserve the right to have him/her to take the legal responsibility if there is any violation.</p>
        <p><strong>6. Obligations of Yuexingtrip.com</strong></p>
        <p>a. Good maintenance in the network and communication system to ensure the smooth and efficient of this website.</p>
        <p>b. Except from the irresistible factors leading to temporary malfunctioning of the website, such as the need to stop the part or all of the website service, we will notice in advance on this website.</p>
        <p>c. If this website cannot work temporarily due to system maintenance or upgrade, we will be inform members by on the home page, or email etc.</p>
        <p>d. If any irresistible reason leading to the suspension of the website, any actual or potential losses resulted from the suspension shall not be compensated.</p>
        <p>e. The websiteis not responsible for any losses resulted from the lose of password by member.</p>
        <p>f. The website only provide network services, but to the related web services related equipment (such as computers, modems and other device) associated with access to the Internet and the costs of (such as networking fee and pay for access to the Internet) shall be borne by members.</p>
        <p><strong>7. Supplementary articles</strong></p>
        <p>a. The above rules are only restricted in Yuexingtrip.com.</p>
        <p>b. Our members violate the above rules or the relevant laws will bear the consequences themselves. The website does not take any responsibility.</p>
        <p>c. Any issues our rules have not involved can be referred to the relevant laws and regulations. When our rules conflict with the relevant laws and regulations, the relevant laws and regulations shall prevail. Within the scope of the clauses, Yuexingtrip.com has the final explanation right.</p>
        <?php endif;?>
    </div>
</div>
@stop
