const financeMenu = {
	homeLink: '/finance/',
	tree: [
		{
			titleClass: 'type-finance-1',
			text: '业绩查询',
			isOpen: false,
			subs: [
				{
					text: '业绩日报',
					link: '/results/report',
					selected: false,
				},
				{
					text: '业绩统计',
					link: '/results/statistics',
					selected: false,
				},
			]
		},
		{
			titleClass: 'type-finance-2',
			text: '工资报表',
			isOpen: false,
			subs: [
				{
					text: '工资详情',
					link: '',
					selected: false,
				},
				{
					text: '工资统计',
					link: '',
					selected: false,
				},
			]
		},
		{
			titleClass: 'type-finance-3',
			text: '经营分析',
			isOpen: false,
			subs: [
				{
					text: '分析报告',
					link: '',
					selected: false,
				},
				{
					text: '收入中心',
					link: '',
					selected: false,
				},
				{
					text: '成本分析',
					link: '',
					selected: false,
				},
				{
					text: '利润中心',
					link: '',
					selected: false,
				},
				{
					text: '外部数据上传',
					link: '',
					selected: false,
				}
			]
		},
	]
}

module.exports = financeMenu;