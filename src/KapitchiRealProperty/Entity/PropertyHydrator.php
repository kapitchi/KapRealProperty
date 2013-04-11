<?php
namespace KapitchiRealProperty\Entity;

/**
 *
 * @author Matus Zeman <mz@kapitchi.com>
 */
class PropertyHydrator extends \Zend\Stdlib\Hydrator\ClassMethods
{
    public function extract($object) {
        $data = parent::extract($object);
//        if($data['sentTime'] instanceof \DateTime) {
//            $data['sentTime'] = $data['sentTime']->format('Y-m-d\TH:i:sP');//UTC
//        }
//        if($data['receivedTime'] instanceof \DateTime) {
//            $data['receivedTime'] = $data['receivedTime']->format('Y-m-d\TH:i:sP');//UTC
//        }
//        if($data['readTime'] instanceof \DateTime) {
//            $data['readTime'] = $data['readTime']->format('Y-m-d\TH:i:sP');//UTC
//        }
        return $data;
    }

    public function hydrate(array $data, $object) {
//        if(!empty($data['sentTime']) && !$data['sentTime'] instanceof \DateTime) {
//            $data['sentTime'] = new \DateTime($data['sentTime']);
//        }
//        if(!empty($data['receivedTime']) && !$data['receivedTime'] instanceof \DateTime) {
//            $data['receivedTime'] = new \DateTime($data['receivedTime']);
//        }
//        if(!empty($data['readTime']) && !$data['readTime'] instanceof \DateTime) {
//            $data['readTime'] = new \DateTime($data['readTime']);
//        }
        return parent::hydrate($data, $object);
    }
}