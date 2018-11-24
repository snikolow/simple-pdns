import BaseDataTable from '../modules/BaseDataTable';

class Member extends BaseDataTable {

    constructor() {
        super({
            dataTableSelector: 'table[data-role="member-data-table"]',
            properties: {
                columns: [
                    {'data': 'id'},
                    {'data': 'username'},
                    {'data': 'displayName'},
                ],
                actionsCallback: function($table, data) {
                    let editPath = $table.data('edit-link-format').replace('__ID__', data.id);

                    return `
                        <a href="${editPath}" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                    `;
                }
            }
        });
    }

}

new Member();
