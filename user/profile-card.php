            <div class="card hovercard">
                <div class="cardheader">

                </div>
                <div class="avatar">
                    <img alt="" src="uploads/nopic.png">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" a data-toggle='modal' href='lib/modals/private-message.html' data-target='#RemoteModal'><?php echo $User["Username"];?></a>
                    </div>
                    <div class="desc">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
					<?php echo $User["Firstname"]." ".$User["Lastname"];?>
					</div>
                    <div class="desc">
                    	<?php echo ($User["Status"]=="Offline" ? "<span style='color:red;'>".$User["Status"]."</span>" : "<span style='color:green;'>".$User["Status"]."</span>");?>
                    </div>
                    <div class="desc">Tech geek</div>
                </div>
            </div>