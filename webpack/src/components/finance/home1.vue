<!--http://localhost/webpack-dev-server/dist/html/finance.html#!/home-->
<template>
    <!--content--wrap 统一的包裹--> 
    <div class="content--wrap content--home">
        <!--顶部的-->
        <div class="top-container" style="border:1px solid red;">
            <!--col-xs-8 自适应8格-->
            <!--options没有单独的样式，只是一个目录而已，但是要通过它来路由-->
            <div class="col-xs-8 options">
                <!--一共只有12个，分成6个两半-->
                <div class="col-xs-6 item item-1">
                    <!--高度和宽度是这里设置的？-->
                    <a href="javascript:void(0)" class="item-link">
                        <span class="icon"></span>
                        <span class="text">业绩查询</span>
                    </a>
                </div>
                <div class="col-xs-6 item item-2">
                    <a href="javascript:void(0)" class="item-link">
                        <span class="icon"></span>
                        <span class="text">工资报表</span>
                    </a>
                </div>
                <div class="col-xs-6 item item-3">
                    <a href="javascript:void(0)" class="item-link">
                        <span class="icon"></span>
                        <span class="text">分析报告</span>
                    </a>
                </div>
                <div class="col-xs-6 item item-4">
                    <a href="javascript:void(0)" class="item-link">
                        <span class="icon"></span>
                        <span class="text">薪酬计算</span>
                    </a>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="chunk-content ranking">
                    <div class="chunk-content--head">
                        <div class="left-text">
                            业绩总分动态排行
                        </div>
                        <div class="right-text">
                        <dropdown>
                            <button type="button" class="btn btn-default" data-toggle="dropdown">
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                            </button>
                            <ul slot="dropdown-menu" class="dropdown-menu">
                                <li><a href="javascript:void(0);">个人</a></li>
                                <li><a href="javascript:void(0);">团队</a></li>
                                <li><a href="javascript:void(0);">部门</a></li>
                            </ul>
                        </dropdown>
                            </div>
                    </div>
                    <div class="chunk-content--body">
                        <table>
                            <thead>
                                <tr>
                                    <td>姓名</td>
                                    <td>总分</td>
                                    <td>增长率</td>
                                    <td>状态</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>张三</td>
                                    <td>2800</td>
                                    <td>75%</td>
                                    <td>
                                        <span class="status"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>张三</td>
                                    <td>2800</td>
                                    <td>75%</td>
                                    <td>
                                        <span class="status"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>张三</td>
                                    <td>2800</td>
                                    <td>75%</td>
                                    <td>
                                        <span class="status status__drop"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>张三</td>
                                    <td>2800</td>
                                    <td>75%</td>
                                    <td>
                                        <span class="status"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>张三</td>
                                    <td>2800</td>
                                    <td>75%</td>
                                    <td>
                                        <span class="status"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--底部公告栏-->
        <div class="bottom-container">
            <div class="chunk-content message">
                <div class="chunk-content--head" >
                    <div class="left-text">最新消息</div>
                </div>
                <div class="chunk-content--body">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-lg-1">时间</th>
                                <th class="col-lg-9">内容</th>
                                <th class="col-lg-1">发布者</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2016.03.21</td>
                                <td><a>今晚8点点金社区“李老师”线上报告会。</a></td>
                                <td>牛大大</td>
                            </tr>
                            <tr class="line-two">
                                <td>2016.03.21</td>
                                <td><a>今晚8点点金社区“李老师”线上报告会。</a></td>
                                <td>牛大大</td>
                            </tr>
                        </tbody>
                    </table>
                    <!--分页-->
                    <div class="pagination-container"> 
                        <pagination :total="messageTotal" :index.sync="messageIndex" :pagesize="10"></pagination>
                    </div>
                    <div>底部提示</div>
                </div>
            </div>
        </div>
</template>
<script>
        import { select, option, dropdown } from 'vue-strap';
     import pagination from '../common/pagination';
     export default {
             components: {
            'v-select': select,
            'v-option': option,
            dropdown,
            pagination
        }
     }
</script>
 
<style>

</style>