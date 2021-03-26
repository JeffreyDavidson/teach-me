<div class="datatable-pager datatable-paging-loaded">
    {{ $collection->links() }}
    <div class="datatable-pager-info my-2 mb-sm-0">
        <select wire:model="perPage" class="datatable-pager-size">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="50">50</option>
        </select>
        <span class="datatable-pager-detail">Showing {{ $collection->firstItem() }} - {{ $collection->lastItem() }} of {{ $collection->total() }}</span>
    </div>
</div>
