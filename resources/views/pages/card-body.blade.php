<div class="table-responsive">
    <div class="dataTables_wrapper no-footer">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($income['transactions'] as $transaction)
            <tr>
                <th scope="row">{{ $transaction->date }}</th>
                <td>{{ $transaction->price }}
                    <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a>
                    <a class="delete-transaction-btn text-danger" data-id='' href="#" data-remodal-target="deleteModal"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $income['transactions']->links('pagination.default') }}
    </div>
</div>