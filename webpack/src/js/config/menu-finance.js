const menu = {
	homeLink: '/',
	tree: [
		{
			id: 'result',
			titleClass: 'type-finance-1',
			text: '业绩查询',
			isOpen: false,
			code: '101001',
			subs: [
				{
					id: 'result-report',
					text: '业绩日报',
					link: '/results/report',
					selected: false,
					code: 'm_10100101',
					subPage: {
						center: 'ext1010001',//中心
						department: 'ext1010002',//部门
						team: 'ext1010003',//团队
						personal: 'ext1010004',//个人
					},
				},
				{
					text: '业绩统计',
					id: 'result-statistics',
					link: '/results/statistics',
					selected: false,
					code: 'm_10100102',
				},
			]
		},
		{
			id: 'statistics',
			titleClass: 'type-finance-2',
			text: '工资报表',
			isOpen: false,
			code: '101002',
			subs: [
				{
					text: '工资详情',
					link: '',
					selected: false,
					code: 'm_10100201'
				},
				{
					text: '工资统计',
					link: '',
					selected: false,
					code: 'm_10100202'
				},
			]
		},
		{
			titleClass: 'type-finance-3',
			text: '经营分析',
			isOpen: false,
			code: '101003',
			subs: [
				{
					text: '分析报告',
					link: '',
					selected: false,
					code: 'm_10100301',
				},
				{
					text: '收入中心',
					link: '',
					selected: false,
					code: 'm_10100302',
				},
				{
					text: '成本分析',
					link: '',
					selected: false,
					code: 'm_10100303',
				},
				{
					text: '利润中心',
					link: '',
					selected: false,
					code: 'm_10100304',
				},
				{
					text: '外部数据上传',
					link: '',
					selected: false,
					code: 'm_10100305',
				}
			]
		},
	]
}

const getMenu = (data) => {
	if (!data) return menu;
}

module.exports = getMenu