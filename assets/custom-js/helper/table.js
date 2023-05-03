function loadDataTable (pageTable ,fields,ajaxUrl,notSortIndex= [0,-2,-1]){
	columnx =[];
	$.each(fields, function(key, value) { 		
		columnx = [...columnx, {data :value}];
	});

	
if(pageTable=='CountryTable' || pageTable=='StateTable' || pageTable=='CallActivityTable' || pageTable =='SalesLeadTable'){
	//$("#"+tableID).DataTable().destroy();
	var t = $('#'+pageTable).DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',	
		'pageLength': 50,	
		// "destroy": true,
		'ajax': {
			'url':BASE_URL+ajaxUrl
		},
		'columns': columnx ,
		"columnDefs": [
			{ "orderable": true, "targets": notSortIndex }
		  ]
	});
}
else{
	var t = $('#'+pageTable).DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'pageLength': 50,		
		'order' : [1,'desc'],
		'ordering' : true,
		"destroy": true,
		'ajax': {
			'url':BASE_URL+ajaxUrl
		},
		'columns': columnx ,
		"columnDefs": [
			{ "orderable": false, "targets": notSortIndex }
		  ]
	});
}
	

	t.on( 'draw.dt', function () {
		var PageInfo = $('#'+pageTable).DataTable().page.info();
		t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			} );
		} );
}


function loadDataTableWithFilter(tableID ,fields,ajaxUrl,notSortIndex= [0,-2,-1],filterObj){
	$("#"+tableID).DataTable().destroy();
	columnx =[];
	$.each(fields, function(key, value) { 		
		columnx = [...columnx, {data :value}];
	});
	var t = $('#'+tableID).DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"pageLength": 50,
		'ajax': {
			'url':BASE_URL+ajaxUrl,
            'data':filterObj
		},
		'columns': columnx ,
		"columnDefs": [
			{ "orderable": false, "targets": notSortIndex }
			]
	});

	t.on( 'draw.dt', function () {
		var PageInfo = $('#'+tableID).DataTable().page.info();
		t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			} );
		} );
}
function loadDataTableSOrtable(tableID ,fields,ajaxUrl,notSortIndex= [0,-2,-1]){
	columnx =[];
	$.each(fields, function(key, value) { 		
		columnx = [...columnx, {data :value}];
	});
	var t = $('#'+tableID).DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		"pageLength": 50,
		'ajax': {
			'url':BASE_URL+ajaxUrl,
		},
		createdRow: function(row, data, dataIndex, cells) {
			console.log("data",dataIndex);
			$(row).addClass('myRow');
			$(row).attr('idValue',data.idValue);
			$(row).attr('disporder',data.DispOrder);
		  },
		'columns': columnx ,
		"columnDefs": [
			{ "orderable": false, "targets": notSortIndex }
			]
	});

	t.on( 'draw.dt', function () {
		var PageInfo = $('#'+tableID).DataTable().page.info();
		t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			} );
		} );
}


