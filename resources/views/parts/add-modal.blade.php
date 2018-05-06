<!-- Add Modal -->
<div class="remodal-bg"></div>
<div class="remodal" data-remodal-id="addModal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h1>Add transaction</h1>
    <p>
    <form action="#">
        <div class="form-group">
            <label class="control-label">Date of transaction</label>
            <input type="date" class="form-control" placeholder="dd/mm/yyyy">
        </div>
        <div class="form-group">
            <label class="control-label">Currency</label>
            <select class="form-control custom-select">
                <option value="">BTC</option>
                <option value="">ETH</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Value</label>
            <input type="text" id="valueCrypt" class="form-control" placeholder="0.000000777">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-inverse" data-remodal-action="cancel">Cancel</button>
        </div>
    </form>
    </p>
    <!--<br>
    <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
    <button data-remodal-action="confirm" class="remodal-confirm">OK</button>-->
</div>