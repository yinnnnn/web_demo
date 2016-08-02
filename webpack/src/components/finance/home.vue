<template>
    <div class="content--wrap content--home">
        <div class="top-container">
            <div class="col-xs-8 options">
                <div class="col-xs-6 item item-1">
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
                        <div class="left-text">业绩总分动态排行</div>

                        <div class="right-filter">
                            <dropdown>
                                <button class="filter-btn btn-default-none" data-toggle="dropdown">
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </button>
                                <ul slot="dropdown-menu" class="dropdown-menu">
                                    <li>
                                        <a @click="changeRankingType('personal')" href="javascript:void(0)">
                                            个人
                                            <span class="glyphicon glyphicon-ok" :style="{display: rankingType==='personal'?'inline-block':'none'}" ></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a @click="changeRankingType('team')" href="javascript:void(0)">团队
                                            <span class="glyphicon glyphicon-ok" :style="{display: rankingType==='team'?'inline-block':'none'}" ></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a @click="changeRankingType('dep')" href="javascript:void(0)">部门
                                            <span class="glyphicon glyphicon-ok" :style="{display: rankingType==='dep'?'inline-block':'none'}" ></span>
                                        </a>
                                    </li>
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

        <div class="bottom-container">
            <div class="chunk-content message">
                <div class="chunk-content--head">
                    <div class="left-text">最新消息</div>
                    <div class="right-search">
                        <v-select :close-on-select="true" :value.sync="messageType" :options="messageTypeList">
                        </v-select>
                    </div>
                </div>

                <div class="chunk-content--body">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-lg-1">时间</th>
                                <th class="col-lg-9">内容</th>
                                <th class="col-lg-1">发布者</th>
                                <!-- <th class="col-lg-1"><a class="del-icon"></a></th> -->
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>2016.03.21</td>
                                <td><a>今晚8点点金社区“李老师”线上报告会。</a></td>
                                <td>牛大大</td>
                                <!-- <td><a class="del-icon"></a></td> -->
                            </tr>
                            <tr class="line-two">
                                <td>2016.03.21</td>
                                <td><a>今晚8点点金社区“李老师”线上报告会。</a></td>
                                <td>牛大大</td>
                                <!-- <td><a class="del-icon"></a></td> -->
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        <pagination :total="messageTotal" :index.sync="messageIndex" :pagesize="10"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { select, option, dropdown } from 'vue-strap';
    import pagination from '../common/pagination';
    import sendAjax from '../../js/common/request.js';
    export default {
        data() {
            return  {
                //动态排名类型
                rankingType: 'personal',
                //动态排名展现列表
                rankingList: [],
                //消息类型
                messageType: 'all',
                //消息总条数
                messageTotal: 0,
                //消息列表
                messageList: [],
                //消息列表当前页面
                messageIndex: 1,
                //消息类型
                messageTypeList: [
                    {value: 'all', label: '全部消息'},
                    {value: 'system', label: '系统消息'},
                    {value: 'personal', label: '个人消息'}
                ]
            }
        },
        components: {
            'v-select': select,
            'v-option': option,
            dropdown,
            pagination
        },
        watch: {
            'messageType'(newValue, oldValue) {
                if (newValue == oldValue)
                    return;
                this.getMessageList();
            },
            'messageIndex'(newValue, oldValue) {
                if (newValue == oldValue)
                    return;
                this.getMessageList();
            }
        },
        methods: {
            //排名筛选
            changeRankingType(value) {
                if (value === this.rankingType)
                    return;
                this.rankingType = value;
                this.getRanking();
            },
            //获取排名数据
            getRanking() {

            },
            //获取消息列表
            getMessageList() {

            }
        }
    }
</script>

<style>

</style>