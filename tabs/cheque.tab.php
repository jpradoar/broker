<table width="100%" border="0">
                                  <tr>
                                    <td width="20%">BANCO EMISOR:</td>
                                    <td><input type="text" class="button" id="TXTBcoEmiCHE" name="TXTBcoEmiCHE" value="<?php echo $TXTBcoEmiCHE; ?>" disabled ></td>
                                  </tr>
                                  <tr>
                                    <td>NUMERO DEL CHEQUE:</td>
                                    <td><input type="text" class="button" id="TXTNroEmiCHE" name="TXTNroEmiCHE" value="<?php echo $TXTNroEmiCHE; ?>" disabled></td>
                                  </tr>
                                  <tr>
                                    <td>FECHA DEL CHEQUE:</td>
                                    <td><?php pinto_fecha('FEEmiChe','',$FEEmiChe);?></td>
                                  </tr>
                                  <tr>
                                    <td>EMISOR:</td>
                                    <td><input type="text" class="button" id="TXTPerEmiCHE" name="TXTPerEmiCHE" value="<?php echo $TXTPerEmiCHE; ?>" disabled></td>
                                  </tr>
                                  <tr>
                                    <td>PAGADO A:</td>
                                    <td><input type="text" class="button" id="TXTPagadoCHE" name="TXTPagadoCHE" value="<?php echo $TXTPagadoCHE; ?>" disabled></td>
                                  </tr>
                                  <tr>
                                    <td>FECHA SALIDA CHEQUE:</td>
                                    <td><?php pinto_fecha('FEEmiChe','',$FESalCHE);?></td>
                                  </tr>
                                  <tr>
                                    <td>CONCEPTO INGRESO:</td>
                                    <td><input type="text" class="button" id="TXTConIngCHE" name="TXTConIngCHE" value="<?php echo $TXTConIngCHE; ?>" disabled></td>
                                  </tr>
                                  <tr>
                                    <td>CONCEPTO SALIDA:</td>
                                    <td><input type="text" class="button" id="TXTConSalCHE" name="TXTConSalCHE" value="<?php echo $TXTConSalCHE; ?>" disabled></td>
                                  </tr>
                                  <tr>
                                    <td>FECHA DIFERIDO DEL CHEQUE:</td>
                                    <td><?php pinto_fecha('TXTFeDifCHE','',$TXTFeDifCHE);?></td>
                                  </tr>                                  <tr>
                                    <td>OBSERVACIONES:</td>
                                    <td><input type="text" class="button" id="TXTObservaCHE" name="TXTObservaCHE" value="<?php echo $TXTObservaCHE; ?>" disabled></td>
                                  </tr>
                                </table>