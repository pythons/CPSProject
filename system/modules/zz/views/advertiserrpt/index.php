<link rel="stylesheet" href="<?php echo STATICURL.'/main/css/index.css'; ?>">
<script src='<?php echo STATICURL."/main/js/shop.js"; ?>'></script>
<style type="text/css">
    .time-h{
        position: absolute;
        top: 20px;
        left: 15px;
    }
</style>

<div class="index-table-div">

    <div class="search-box">
        <div class="shop-list-cont" id="shop-search">
            <div class="search-log" style="display: none;"> </div>
            <div class="search-left com-list-tit" style="display: block;">
                <span class="shop-list-icon"></span>
                <span class="shop-list-txt">智·钻</span><small>
                    <a href="<?php echo $this->createUrl("/zz/advertiserhour/index");?>"><span class="label label-default">全店推广<small>(实时报表)</small></span></a>
                    <a href="<?php echo $this->createUrl("/zz/advertiserrpt/index");?>"><span class="label label-info">全店推广<small>(近期报表)</small></span></a>
                    <a href="<?php echo $this->createUrl("/zz/summary/index");?>"><span class="label label-default">店铺统计报表</span></a>
                    <a href="<?php echo $this->createUrl("/zz/summary/pic");?>"><span class="label label-default">人员统计报表</span></a>
                    <a href="<?php echo $this->createUrl("/zz/data/index");?>"><span class="label label-default">报表下载</span></a>

                </small>

            </div>
            <div class="search-right">
                <?php $this->widget("application\\modules\\main\\widgets\\ShopSearchWidget",array("url"=>$this->createUrl("/zz/advertiserrpt/index",array("page"=>1)),"query"=>$query));?>

            </div>
        </div>
    </div>
    <table class="table-frame">
        <tbody id="babyInforTb">
        <?php $i=1;?>
        <?php foreach($list as $row):?>
            <tr <?php if($i%2==0):?>class="stop-tr"<?php endif;?>>
                <?php $i++;?>
                <td class="babyInforTb-td-left">
                    <?php $this->widget("application\\modules\\main\\widgets\\ShopManagerWidget",array("shop"=>$row));?>
                </td>
                <td class="check-infor-td">
                    <div class="baby-box" data-nick="<?php echo $row["nick"];?>" data-role="list">
                        <ul class="nav nav-tabs shop-nav" role="tablist">
                            <li role="presentation">
                                <a data-type="realtime" href="#realtime_<?php echo $row["id"];?>" title="实时状况" aria-controls="realtime_<?php echo $row["id"];?>" role="tab" data-toggle="tab" aria-expanded="true">
                                    <i class="glyphicon glyphicon-flash"></i><span>实时状况</span>
                                </a>
                            </li>
                            <li role="presentation"  class="active">
                                <a data-type="rpt" href="#rpt_<?php echo $row["id"];?>" title="历史报表" aria-controls="rpt_<?php echo $row["id"];?>" role="tab" data-toggle="tab" aria-expanded="true">
                                    <i class="glyphicon glyphicon-stats"></i><span>近期报表<small>(近15天)</small></span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a data-type="rpt_chart" href="#rpt_chart_<?php echo $row["id"];?>" title="近期趋势" aria-controls="rpt_chart_<?php echo $row["id"];?>" role="tab" data-toggle="tab" aria-expanded="true">
                                    <i class="ion-arrow-graph-up-right"></i><span>近期趋势</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane" id="realtime_<?php echo $row["id"];?>">
                                <div class="row" data-tmpl="shop-zuanshi-realtime-list-tmpl" data-role="shop-zuanshi-realtime-list" data-url="<?php echo $this->createUrl("/zz/advertiserhour/getbynick",array("nick"=>$row["nick"]));?>" >

                                </div>

                                <div class="row padding" data-tmpl="shop-campaign-budget-warning-tmpl" data-role="shop-campaign-budget-warning" data-url="<?php echo $this->createUrl("/zuanshi/campaign/getbudgetwarning",array("nick"=>$row["nick"]));?>">

                                </div>
<!--                                <div class="row">-->
<!--                                    <div class="col-md-11">-->
<!---->
<!--                                    </div>-->
<!--                                    <div class="col-md-1">-->
<!--                                        <small>-->
<!--                                            <a class="label label-primary" href="--><?php //echo $this->createUrl("/zuanshi/advertiser/more",array("nick"=>$row["nick"]));?><!--">详情</a>-->
<!--                                        </small>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>

                            <div role="tabpanel" class="tab-pane container-fluid active" id="rpt_<?php echo $row["id"];?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <a href="javascript:void(0)" data-role="refresh"><small><i class="glyphicon glyphicon-refresh"></i> 更新</small></a>
                                    </div>
                                    <div class="col-md-9">

                                    </div>
                                    <div class="col-md-1">

                                        <a href="<?php echo $this->createUrl("/zz/advertiserrpt/more",array("nick"=>$row["nick"]));?>"> <small>更多..</small></a>
                                    </div>
                                </div>
                                <div class="row" data-role="advertiserrpt" data-tmpl="zuanshi-advertiserrpt-list-tmpl" data-load="overlay" data-url="<?php echo $this->createUrl("/zz/advertiserrpt/getbynick",array("nick"=>$row["nick"],"shopname"=>$row["shopname"]));?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-11">

                                    </div>
                                    <div class="col-md-1">

                                        <a href="<?php echo $this->createUrl("/zz/advertiserrpt/more",array("nick"=>$row["nick"]));?>"> <small>更多..</small></a>
                                    </div>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane" id="rpt_chart_<?php echo $row["id"];?>">
                                <div data-role="rpt_chart" data-url="<?php echo $this->createUrl("/zz/advertiserrpt/getbynick",array("nick"=>$row["nick"],"shopname"=>$row["shopname"]));?>">
                                </div>
                            </div>


                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <div class="c-pager">
    </div>
</div>


<script type="text/x-jquery-tmpl" id="shop-zuanshi-realtime-list-tmpl">
 {{if !isSuccess}}
    <div>
        <p class="text-danger">安装插件后，登录钻石展位即可同步展示！</p>
    </div>
    {{else}}
     <div class="col-md-12">
       <div>
           <div class="time-h"><o class="tit">${data.loghour}时</o></div>
           {{if data.account.warning}}
                <div class="stop-icon"></div>
           {{/if}}

           <div class="padding"><div class="col-md-6 col-lg-4 col-sm-6">
            <p class=" text-center">
                <small>余额(元)</small>
            </p>

            <h3 class="text-center padding" {{if data.account.warning}}style="color: red"{{/if}}>${data.account.balance}</h3>

           </div>
           <div class="col-md-6 col-lg-4 col-sm-6">
             <p class=" text-center">
               <small>今日预算(元)</small>
             </p>
               <h3 class="text-center padding">
                  {{if data.account.zuanshi_budget>0 && data.account.zuanshi_budget!=data.account.dayBudget}}
                    <strong>${data.account.zuanshi_budget}</strong> / <small>${data.account.dayBudget}</small>
                  {{else}}
                    ${data.account.dayBudget}
                  {{/if}}

               </h3>
           </div>
           <div class="col-md-6 col-lg-4 col-sm-6">
             <p class=" text-center">
               <small>昨日消耗(元)</small>
             </p>
             <h3 class="text-center padding">
                ${data.account.yesterdayDeduct}
             </h3>
           </div>

       </div>
       <div class="padding">
          <div class="col-md-6 col-lg-4 col-sm-6" style="background: aliceblue;">
             <div class="inner padding">
                <p class=" text-center">
                   <small>实时消耗(元)</small>
                </p>
             <h3 class="text-center padding">
                ${data.today.charge}
             </h3>
             <ul class="d-ul padding">

                <li class="col-md-6">
                    <p><small>较同时刻</small></p>
                    {{if data.cur_yesterday.chargeGrowth<0}}
                        {{if Math.abs(data.cur_yesterday.chargeGrowth)>=30}}
                        <p style="color: red">-<b>${Math.abs(data.cur_yesterday.chargeGrowth)}%</b></p>
                        {{else}}
                        <p>-<b>${Math.abs(data.cur_yesterday.chargeGrowth)}%</b></p>
                        {{/if}}

                    {{else}}
                        {{if data.cur_yesterday.chargeGrowth>0}}
                            {{if Math.abs(data.cur_yesterday.chargeGrowth)>=30}}
                            <p style="color: red">+<b>${Math.abs(data.cur_yesterday.chargeGrowth)}%</b></p>
                            {{else}}
                            <p>+<b>${Math.abs(data.cur_yesterday.chargeGrowth)}%</b></p>
                            {{/if}}
                        {{else}}
                            <p><b>0%</b></p>
                        {{/if}}
                    {{/if}}

                </li>
                <li class="col-md-6">
                   <p><small>同时刻</small></p>
                   <p>
                       ${data.cur_yesterday.charge}
                   </p>
                </li>

             </ul>
             <ul class="d-ul">

                <li class="col-md-6">
                   <p><small>消耗占比</small></p>
                   <p><b>${data.yesterday.chargeRate}%</b></p>
                </li>
                <li class="col-md-6">
                   <p><small>预算</small></p>
                   <p>
                       {{if data.account.zuanshi_budget>0}}${data.account.zuanshi_budget}  {{else}} ${data.account.dayBudget}{{/if}}
                   </p>

                </li>

             </ul>

            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-sm-6" style="background: aliceblue;border-left: 1px solid azure;border-right: 1px solid azure;">
          <div class="inner padding">

          <p class=" text-center">
          <small>点击单价(元)</small>
          </p>
          <h3 class="text-center padding">
                ${data.today.ecpc}
          </h3>
          <ul class="d-ul padding">
            <li class="col-md-6 col-sm-12">
              <p><small>较同时刻</small></p>
                {{if data.cur_yesterday.ecpcGrowth<0}}
                        {{if Math.abs(data.cur_yesterday.ecpcGrowth)>=30}}
                        <p style="color: red">-<b>${Math.abs(data.cur_yesterday.ecpcGrowth)}%</b></p>
                        {{else}}
                        <p>-<b>${Math.abs(data.cur_yesterday.ecpcGrowth)}%</b></p>
                        {{/if}}

                    {{else}}
                        {{if data.cur_yesterday.ecpcGrowth>0}}
                            {{if Math.abs(data.cur_yesterday.ecpcGrowth)>=30}}
                            <p style="color: red">+<b>${Math.abs(data.cur_yesterday.ecpcGrowth)}%</b></p>
                            {{else}}
                            <p>+<b>${Math.abs(data.cur_yesterday.ecpcGrowth)}%</b></p>
                            {{/if}}
                        {{else}}
                            <p><b>0%</b></p>
                        {{/if}}
                    {{/if}}


            </li>
            <li class="col-md-6 col-sm-12">
              <p><small>同时刻</small></p>
              <p>${data.cur_yesterday.ecpc}</p>
            </li>
          </ul>

          <ul class="d-ul">

             <li class="col-md-6 col-sm-12">
               <p><small>较昨日</small></p>
               <p>

                {{if data.yesterday.ecpcGrowth<0}}
                        {{if Math.abs(data.yesterday.ecpcGrowth)>=30}}
                        <p style="color: red">-<b>${Math.abs(data.yesterday.ecpcGrowth)}%</b></p>
                        {{else}}
                        <p>-<b>${Math.abs(data.yesterday.ecpcGrowth)}%</b></p>
                        {{/if}}

                    {{else}}
                        {{if data.yesterday.ecpcGrowth>0}}
                            {{if Math.abs(data.yesterday.ecpcGrowth)>=30}}
                            <p style="color: red">+<b>${Math.abs(data.yesterday.ecpcGrowth)}%</b></p>
                            {{else}}
                            <p>+<b>${Math.abs(data.yesterday.ecpcGrowth)}%</b></p>
                            {{/if}}
                        {{else}}
                            <p><b>0%</b></p>
                        {{/if}}
                    {{/if}}
               </p>

             </li>
             <li class="col-md-6 col-sm-12">
               <p><small>昨日</small></p>
               <p>
               <p>${data.yesterday.ecpc}</p>


             </li>
          </ul>
          </div>
          </div>


          <div class="col-md-6 col-lg-4 col-sm-6" style="background: aliceblue">
          <div class="inner padding">

          <p class=" text-center">
               <small>点击率(%)</small>
          </p>
          <h3 class="text-center padding"> ${data.today.ctrStr}</h3>
          <ul class="d-ul padding">
          <li class="col-md-6 col-sm-12"><p><small>较同时刻</small></p>
            {{if data.cur_yesterday.ctrGrowth<0}}
                        {{if Math.abs(data.cur_yesterday.ctrGrowth)>=30}}
                        <p style="color: red">-<b>${Math.abs(data.cur_yesterday.ctrGrowth)}%</b></p>
                        {{else}}
                        <p>-</i><b>${Math.abs(data.cur_yesterday.ctrGrowth)}%</b></p>
                        {{/if}}

                    {{else}}
                        {{if data.cur_yesterday.ctrGrowth>0}}
                            {{if Math.abs(data.cur_yesterday.ctrGrowth)>=30}}
                            <p style="color: red">+<b>${Math.abs(data.cur_yesterday.ctrGrowth)}%</b></p>
                            {{else}}
                            <p>+<b>${Math.abs(data.cur_yesterday.ctrGrowth)}%</b></p>
                            {{/if}}
                        {{else}}
                            <p><b>0%</b></p>
                        {{/if}}
                    {{/if}}

          </li>
          <li class="col-md-6 col-sm-12">
             <p><small>同时刻</small></p>
             <p>
                <p>${data.cur_yesterday.ctrStr}</p>
             </p>
          </li>
       </ul>

       <ul class="d-ul">
       <li class="col-md-6">
       <p><small>较昨日</small></p>
       <p>

                  {{if data.yesterday.ctrGrowth<0}}
                        {{if Math.abs(data.yesterday.ctrGrowth)>=30}}
                        <p style="color: red">-<b>${Math.abs(data.yesterday.ctrGrowth)}%</b></p>
                        {{else}}
                        <p>-<b>${Math.abs(data.yesterday.ctrGrowth)}%</b></p>
                        {{/if}}

                    {{else}}
                        {{if data.yesterday.ctrGrowth>0}}
                            {{if Math.abs(data.yesterday.ctrGrowth)>=30}}
                            <p style="color: red">+<b>${Math.abs(data.yesterday.ctrGrowth)}%</b></p>
                            {{else}}
                            <p>+<b>${Math.abs(data.yesterday.ctrGrowth)}%</b></p>
                            {{/if}}
                        {{else}}
                            <p>-<b>0%</b></p>
                        {{/if}}
                    {{/if}}
       </p>

       </li>
       <li class="col-md-6 col-sm-12">
       <p><small>昨日</small></p>
       <p>
              ${data.yesterday.ctrStr}
       </p>

       </li>
     </ul>


     </div>


     </div>


</div>

</div>
{{/if}}
</script>

<script type="text/x-jquery-tmpl" id="shop-campaign-budget-warning-tmpl">
{{if isSuccess}}
    <div>
    <small class="glyphicon glyphicon-info-sign"></small>
    <small>截止${data.loghour}h内,</small>
    <small>计划预算消耗占比</small>

    {{if data.low.count>0}}
        <small>小于50%（
        <b style="color:red;padding-right:2px">${data.low.count}个</b>
        ）</small>
    {{/if}}

    {{if data.max.count>0}}
        <small>大于80%(
        <b style="color:red;padding-right:2px">${data.max.count}个</b>
        )</small>
    {{/if}}
    </div>

{{/if}}
</script>

<script type="text/x-jquery-tmpl" id="zuanshi-advertiserrpt-list-tmpl">
 {{if !isSuccess}}
    <div>
        <p class="text-danger">安装插件后，登录钻石展位即可同步展示！</p>
    </div>
 {{else}}
    <table data-role="list" class="baby-frame-table" style="table-layout: fixed;">
        <thead>
        <tr class="small">
            <th>日期</th>
            <th>展现</th>
            <th>点击</th>
            <th>点击率</th>
            <th>消耗</th>
            <th>点击单价</th>
            <th>收藏数</th>
            <th>3天订单数</th>
            <th>7天订单数</th>
            <th>15天订单数</th>
            <th>3天回报率</th>
            <th>7天回报率</th>
            <th>15天回报率</th>
            <th>全店营业额</th>
            <th>消耗占比(%)</th>
        </tr>
        </thead>
        <tbody>
        {{each(i,rpt) data.click3.list}}
            <tr class="small"><td><strong>${rpt.logDate}</strong></td>
            <td>${rpt.adPv}</td>
            <td>${rpt.click}</td>
            <td>
            {{if rpt.ctr>0}}
                ${(rpt.ctr*100).toFixed(2)}
            {{else}}
                0
            {{/if}}
            </td>
            <td>${rpt.charge}</td>
            <td>
            {{if rpt.ecpc>0}}
                ${rpt.ecpc.toFixed(2)}
            {{else}}
                0
            {{/if}}
            </td>
            <td>${rpt.dirShopColNum+rpt.inshopItemColNum}</td>
            <td>${rpt.alipayInShopNum}</td>
            <td>
            {{if data["click7"]["list"][i]}}
                ${data["click7"]["list"][i]["alipayInShopNum"]}
            {{else}}
                -
            {{/if}}
            </td>
            <td>
            {{if data["click15"]["list"][i]}}
                ${data["click15"]["list"][i]["alipayInShopNum"]}
            {{else}}
                -
            {{/if}}
            </td>
            <td>
            {{if rpt.roi>0}}
                ${rpt.roi.toFixed(2)}
            {{else}}
                0
            {{/if}}
            </td>
            <td>
            {{if data["click7"]["list"][i]}}
                {{if data["click7"]["list"][i]["roi"]}}
                    ${data["click7"]["list"][i]["roi"].toFixed(2)}
                {{else}}
                    0
                {{/if}}
            {{else}}
                -
            {{/if}}
            </td>
            <td>
            {{if data["click15"]["list"][i]}}
                {{if data["click15"]["list"][i]["roi"]}}
                    ${data["click15"]["list"][i]["roi"].toFixed(2)}
                {{else}}
                    0
                {{/if}}
            {{else}}
                -
            {{/if}}
            </td>
            <td>
              {{if data["trade"]["list"][i]}}
                ${data["trade"]["list"][i]["payAmt"]}
              {{else}}
                -
              {{/if}}
            </td>
            <td>
                {{if data["trade"]["list"][i]}}
                    {{if data["trade"]["list"][i]["payAmt"]>0}}
                        ${(rpt.charge/data["trade"]["list"][i]["payAmt"]*100).toFixed(2)}
                    {{else}}
                        0
                    {{/if}}
                {{else}}
                    -
                {{/if}}
            </td>
            </tr>
        {{/each}}

        {{if data.click3.total}}

            <tr class="small"><td><strong>总计</strong></td>
            <td>${data.click3.total.adPv}</td>
            <td>${data.click3.total.click}</td>
            <td>
            {{if data.click3.total.ctr>0}}
                ${(data.click3.total.ctr*100).toFixed(2)}
            {{else}}
                0
            {{/if}}
            </td>
            <td>${data.click3.total.charge}</td>
            <td>
            {{if data.click3.total.ecpc>0}}
                ${data.click3.total.ecpc.toFixed(2)}
            {{else}}
                0
            {{/if}}
            </td>
            <td>${data.click3.total.dirShopColNum+data.click3.total.inshopItemColNum}</td>
            <td>${data.click3.total.alipayInShopNum}</td>
            <td>
            {{if data.click7.total}}
                ${data.click7.total.alipayInShopNum}
            {{else}}
                -
            {{/if}}
            </td>
            <td>
            {{if data.click15.total}}
                ${data.click15.total.alipayInShopNum}
            {{else}}
                -
            {{/if}}
            </td>
            <td>${data.click3.total.roi}</td>
            <td>
            {{if data.click7.total}}
                ${data.click7.total.roi}
            {{else}}
                -
            {{/if}}
            </td>
            <td>
            {{if data.click15.total}}
                ${data.click15.total.roi}
            {{else}}
                -
            {{/if}}
            </td>
            <td>${data.trade.total.payAmt}</td>
            <td>
                {{if data.trade.total.payAmt>0}}
                    ${(data.click3.total.charge/data.trade.total.payAmt*100).toFixed(2)}
                {{else}}
                    -
                {{/if}}
            </td>
            </tr>
        {{/if}}
        </tbody>

    </table>
{{/if}}
</script>

<script type="application/javascript">

    $(document).ready(function(){


        $(".top-ul>li").eq(1).addClass("top-li-hover");

        $(".c-pager").jPager({currentPage: <?php echo $pager["page"]-1;?>, total: <?php echo $pager["count"];?>, pageSize: <?php echo $pager["page_size"];?>,events: function(dp){
            location.href = app.url("<?php echo $this->createUrl('/zz/advertiserrpt/index');?>",{page:dp.index+1})
        }});

        $("a[data-type=realtime]").click(function(e) {
            e.preventDefault();
            var self = $(this);
            self.tab("show");
            var target = $(self.attr("href")).find("[data-role=shop-zuanshi-realtime-list]");
            target.iLoad();

            var t = $(self.attr("href")).find("[data-role=shop-campaign-budget-warning]");
            t.iLoad();

        });

        app.charts.zuanshi_custdata = function(data) {
            return {
                chart: {
                    width: 1100
                },
                title: {
                    text: ""
                },
                xAxis: {
                    categories: $(data).map(function (k, v) {
                        return v.logDate;
                    }),
                    tickInterval:3,
                    tickPosition: 'outside',
                    tickmarkPlacement: 'on',
                    gridLineWidth: 1,
                    gridLineColor:"#e2e2e2",
                    gridLineDashStyle:"Dash"
                    //labels: {
                    //    formatter: function () {
                    //        var labelVal = this.value;
                    //        var reallyVal = labelVal;
                    //        if (Object.keys(data).length > 7) {
                    //            reallyVal = labelVal.substring(0, labelVal.length - 3) + "<br/>" + labelVal.substring(2, labelVal.length - 2) + "<br/>" + labelVal.substring(3, labelVal.length);
                    //        } else {
                    //            reallyVal = labelVal.substring(0, labelVal.length);
                    //        }
                    //        return reallyVal;
                    //    }
                    //}
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true //显示每条曲线每个节点的数据项的值
                        },
                        enableMouseTracking: true
                    },
                    column: {
                        dataLabels: {
                            enabled: false
                        },
                        enableMouseTracking: true
                    },
                    spline: {
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                return this.y + '';
                            }
                        },
                        enableMouseTracking: true
                    }
                },
                yAxis: [
                    {
                        labels: {
                            format: '{value}%',
                            style: {
                                color: '#2FCD71'
                            }
                        }, title: {
                            text: ''
                        },
                        min: 0
                    },
                    {
                        labels: {
                            format: '{value}元',
                            style: {
                                color: '#3499DC'
                            }
                        }, title: {
                            text: ''
                        }
                    },
                    {
                        labels: {
                            format: '{value}次',
                            style: {
                                color: '#3499DC'
                            }
                        }, title: {
                            text: ''
                        },
                        opposite: true,
                        min: 0,
                        allowDecimals: false
                    },
                    {
                        labels: {
                            format: '{value}k',
                            style: {
                                color: '#2FCD71'
                            }
                        }, title: {
                            text: ''
                        },
                        opposite: true
                    },
                    {
                        labels: {
                            format: '{value}笔',
                            style: {
                                color: '#3499DC'
                            }
                        }, title: {
                            text: ''
                        },
                        opposite: true,
                        min: 0,
                        allowDecimals: false
                    },
                    {
                        labels: {
                            format: '{value}',
                            style: {
                                color: '#2FCD71'
                            }
                        }, title: {
                            text: ''
                        },
                        min: 0
                    }
                ],
                series: [
                    {
                        type: 'column',
                        name: '消耗',
                        yAxis: 1,
                        data: app.charts.formatData(data, 'charge'),
                        color: '#3499DC'
                    },
                    {
                        type: 'column',
                        name: '转化金额',
                        yAxis: 1,
                        data: app.charts.formatData(data, 'alipayInshopAmt'),
                        color: '#FA6E50'
                    },
                    {
                        type: 'spline',
                        name: '3天订单数',
                        yAxis: 4,
                        data: app.charts.formatData(data, 'alipayInShopNum'),
                        marker: {
                            lineWidth: 2,
                            lineColor: '#9378D8',
                            fillColor: '#9378D8'
                        },
                        color: '#9378D8',
                        visible: false
                    },
                    {
                        type: 'spline',
                        name: '点击',
                        yAxis: 2,
                        data: app.charts.formatData(data, 'click'),
                        marker: {
                            lineWidth: 2,
                            lineColor: '#1ABC9D',
                            fillColor: '#1ABC9D'
                        },
                        color: '#1ABC9D',
                        visible: false
                    },
                    {
                        type: 'spline',
                        name: '宝贝收藏',
                        yAxis: 2,
                        data: app.charts.formatData(data, 'inshopItemColNum'),
                        marker: {
                            lineWidth: 2,
                            lineColor: '#0086AA',
                            fillColor: '#0086AA'
                        },
                        color: '#0086AA',
                        visible: false
                    },
                    {
                        type: 'spline',
                        name: '店铺收藏',
                        yAxis: 2,
                        data: app.charts.formatData(data, 'dirShopColNum'),
                        marker: {
                            lineWidth: 2,
                            lineColor: '#E55778',
                            fillColor: '#E55778'
                        },
                        color: '#E55778',
                        visible: false
                    },
                    {
                        type: 'spline',
                        name: '展现',
                        yAxis: 2,
                        data: app.charts.formatData(data, 'adPv'),
                        marker: {
                            lineWidth: 2,
                            lineColor: '#E98223',
                            fillColor: '#E98223'
                        },
                        color: '#E98223',
                        visible: false
                    },
                    {
                        type: 'spline',
                        name: '点击率',
                        yAxis: 0,
                        data: app.charts.formatDataToPercent(data, 'ctr'),
                        marker: {
                            lineWidth: 2,
                            lineColor: '#92B1DA',
                            fillColor: '#92B1DA'
                        },
                        color: '#92B1DA',
                        visible: false
                    },
//                    {
//                        type: 'spline',
//                        name: '转化率',
//                        yAxis: 0,
//                        data: app.charts.formatData(data, 'ci'),
//                        marker: {
//                            lineWidth: 2,
//                            lineColor: '#E55778',
//                            fillColor: '#E55778'
//                        },
//                        color: '#E55778',
//                        visible: false
//                    },
                    {
                        type: 'spline',
                        name: '点击单价',
                        yAxis: 1,
                        data: app.charts.formatData(data, 'ecpc'),
                        marker: {
                            lineWidth: 2,
                            lineColor: '#377700',
                            fillColor: '#377700'
                        },
                        color: '#377700',
                        visible: false
                    },
                    {
                        type: 'spline',
                        name: '投资回报率',
                        yAxis: 5,
                        data: app.charts.formatData(data, 'roi'),
                        marker: {
                            lineWidth: 2,
                            lineColor: '#377700',
                            fillColor: '#377700'
                        },
                        color: '#377700',
                        visible: false
                    }
                ]
            };
        };

        //$("[data-toggle=popover]").popover({html : true});
        $("a[data-type=rpt_chart]").click(function(e){
            e.preventDefault();
            var self = $(this);
            var target = $(self.attr("href")).find("[data-role=rpt_chart]");
            var url = target.data("url");
            $.get(url,{},function(resp){
                var data = [];
                if(resp.isSuccess){
                    $.each(resp.data.click3.list,function(v){
                        data.push(this);
                    });
                }
                var config = app.charts.zuanshi_custdata(data);
                config.chart.width = target.width();
                target.highcharts(config);
                self.tab('show');
            });

        });


        $("a[data-role=refresh]").click(function(){
            var self = $(this);
            self.parents(".tab-pane").find("[data-role=advertiserrpt]").iLoad();
        });


    });

</script>

