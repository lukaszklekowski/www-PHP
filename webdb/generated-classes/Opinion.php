<?php

use Base\Opinion as BaseOpinion;

/**
 * Skeleton subclass for representing a row from the 'opinion' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Opinion extends BaseOpinion
{
  public function preInsert()
    {
      $this->setCreatedAt(time());
      return true;
    }
}
