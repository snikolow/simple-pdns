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
                columns: [
                    {'data': 'id'},
                    {'data': 'name'},
                    {
                        data: null,
                        className: 'center',
                        render: function(data) {
                            return `
                                <button class="btn btn-sm btn-default">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </button>
                            `;
                        }
                    }
                ],
                drawCallback: function(settings) {
                    // Wrap the table in table-responsive class after the ajax request has been made.
                    // A bug in the Bootstrap responsive table causes the container to create a horizontal
                    // scroll after the page. Adding "width 100%" to the table solves the problem for now.
                    $(document).find('table[data-role="domain-data-table"]').wrap('<div class="table-responsive"></div>');
                }
            }
        );
    }

}

const domain = new Domain();
