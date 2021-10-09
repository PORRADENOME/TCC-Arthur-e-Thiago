
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#adicionarServico">
                        Adicionar serviço
                    </button>


                    <!-- Modal de Serviços -->
                    <div class="modal fade" id="adicionarServico" tabindex="-1" role="dialog" aria-labelledby="adicionarServicoLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="adicionarServicoLabel">Adicionando serviço</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="inserirServico.php" method="post" class="jsonForm">
                                        <div class="form-group">
                                            <label for="idservico">Serviço</label>
                                            <select class="form-control" id="idservico" name="idservico" required >
                                                <option value="">- Selecione o serviço -</option>
                                                <?php
                                                while($linhaServico = $queryServico->fetch()){
                                                    echo "<option value='{$linhaServico->id}'>{$linhaServico->nome} - R$ {$linhaServico->valor}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!--                                <div class="form-group">-->
                                        <!--                                    <label for="valor">Valor</label>-->
                                        <!--                                    <input type="number" min="1" step="any" class="form-control" id="valor" name="valor" required>-->
                                        <!--                                </div>-->
                                        <div class="form-group">
                                            <input type="hidden" name="idatendimento" value="<?php echo $_GET['id']; ?>">
                                            <button type="submit" class="btn btn-success" >Salvar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fim do modal de Serviços -->


                    <!-- inicio do bootgrid de serviço -->
                    <table id="grid-servico" class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th data-column-id="id" >Código</th>
                            <th data-column-id="nome" data-order="asc" data-sortable="true">Serviço</th>
                            <th data-column-id="descricao" data-sortable="true" data-visible="false">Descrição</th>
                            <th data-column-id="valor" data-sortable="true">Valor</th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false">Ações</th>
                        </tr>
                        </thead>
                    </table>
                    <!-- fim do bootgrid de serviço-->
