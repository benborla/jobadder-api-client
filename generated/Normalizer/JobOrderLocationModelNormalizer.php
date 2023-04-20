<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class JobOrderLocationModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\JobOrderLocationModel') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\JobOrderLocationModel) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\JobOrderLocationModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'locationId')) {
            $object->setLocationId($data->{'locationId'});
        }
        if (property_exists($data, 'name')) {
            $object->setName($data->{'name'});
        }
        if (property_exists($data, 'area')) {
            $object->setArea($this->serializer->deserialize($data->{'area'}, 'BenBorla\\JobAdder\\V2\\Model\\JobOrderLocationAreaModel', 'raw', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getLocationId()) {
            $data->{'locationId'} = $object->getLocationId();
        }
        if (null !== $object->getName()) {
            $data->{'name'} = $object->getName();
        }
        if (null !== $object->getArea()) {
            $data->{'area'} = $this->serializer->serialize($object->getArea(), 'raw', $context);
        }

        return $data;
    }
}
