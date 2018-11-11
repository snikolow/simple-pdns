require('datatables');
require('datatables.net-bs4');

class Domain {

    constructor() {
        this.createDataTable();
    }

    createDataTable() {
        var $target = $('table[data-role="domain-data-table"]');

        if (!$target.length) {
            console.log('[Domain] Data table is missing!');
            return;
        }

        if (typeof $.fn.dataTable === 'undefined') {
            console.log('[Domain] DataTable plugin not loaded!');
            return;
        }

        $target.dataTable(
            {
                searching: false,
                lengthChange: false,
                ordering: false,
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: $target.data('url'),
                columns: [
                    {'data': 'id'},
                    {'data': 'name'}
                ]
            }
        );
    }

}

const domain = new Domain();
