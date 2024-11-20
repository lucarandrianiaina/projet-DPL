<!-- modal de modification -->
<div class="modal fade" id="<?= $printId?>" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">confirmer votre impression</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                </div>
                                <div class="modal-body">
                                    <h5>
                                        vouler vous vraiment imprimer cette activité
                                    </h5>
                                </div>
                                <div class="modal-footer">
                                    <a href="../model/imprime_activite.php?id=<?= $value['id_a'] ?>" class="btn btn-primary">OUI(je veut imprimer)</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">NON</button>
                                </div>
                            </div>
                        </div>
                    </div>