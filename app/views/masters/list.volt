<div class="row">

    <div class="col-sm-12">
        <nav>
            <ul class="pager">
                <li class="previous">{{ link_to("masters/index", "Go Back") }}</li>
                <li class="next">{{ link_to("masters/new", "Create ") }}</li>
            </ul>
        </nav>
    </div>
    
    <div class="col-sm-12 page-header">
        <h1>Search result</h1>
    </div>
    
    {{ content() }}

    <div class="col-sm-12 msgs"></div>
    
    <div class="col-sm-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                <th>Name</th>
                <th>Surname</th>
    
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            {% if page.items is defined %}
            {% for master in page.items %}
                <tr>
                    <td>{{ master.id }}</td>
                <td>{{ master.name }}</td>
                <td>{{ master.surname }}</td>
    
                    <td>{{ link_to("masters/edit/"~master.id, "Edit") }}</td>
                    <td>
                      <!-- {{ link_to("masters/delete/"~master.id, "Delete") }} -->
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                      data-id="{{ master.id }}">
                          Delete
                      </button>
                    </td>
                </tr>
            {% endfor %}
            {% endif %}
            </tbody>
        </table>
    </div>
    
    <div class="col-sm-12">
        <div class="col-sm-1">
            <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
                {{ page.current~"/"~page.total_pages }}
            </p>
        </div>
        <div class="col-sm-11">
            <nav>
                <ul class="pagination">
                    <li>{{ link_to("masters/search", "First") }}</li>
                    <li>{{ link_to("masters/search?page="~page.before, "Previous") }}</li>
                    <li>{{ link_to("masters/search?page="~page.next, "Next") }}</li>
                    <li>{{ link_to("masters/search?page="~page.last, "Last") }}</li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary delete">Delete</button>
        </div>
    </div>
    </div>
</div>
