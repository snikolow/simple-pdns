require('datatables');
require('datatables.net-bs4');

class Domain {

    constructor() {
        this.createDataTable();
    }

    createDataTable() {
        let $target = $('table[data-role="domain-data-table"]');

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
                        className: 'text-center',
                        render: function(data) {
                            let editPath = $target.data('edit-link-format').replace('__ID__', data.id);
                            let recordPath = $target.data('record-link-format').replace('__ID__', data.id);

                            return `
                                <a href="${editPath}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                                <a href="${recordPath}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-list"></i>
                                    Records
                                </a>
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
