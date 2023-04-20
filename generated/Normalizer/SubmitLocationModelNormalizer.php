<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class SubmitLocationModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\SubmitLocationModel') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\SubmitLocationModel) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\SubmitLocationModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'locationId')) {
            $object->setLocationId($data->{'locationId'});
        }
        if (property_exists($data, 'areaId')) {
            $object->setAreaId($data->{'areaId'});
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getLocationId()) {
            $data->{'locationId'} = $object->getLocationId();
        }
        if (null !== $object->getAreaId()) {
            $data->{'areaId'} = $object->getAreaId();
        }

        return $data;
    }
}
