<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class StatusRepresentationNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\StatusRepresentation') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\StatusRepresentation) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\StatusRepresentation();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'statusId')) {
            $object->setStatusId($data->{'statusId'});
        }
        if (property_exists($data, 'name')) {
            $object->setName($data->{'name'});
        }
        if (property_exists($data, 'active')) {
            $object->setActive($data->{'active'});
        }
        if (property_exists($data, 'default')) {
            $object->setDefault($data->{'default'});
        }
        if (property_exists($data, 'links')) {
            $object->setLinks($this->serializer->deserialize($data->{'links'}, 'BenBorla\\JobAdder\\V2\\Model\\ModelLinks', 'raw', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getStatusId()) {
            $data->{'statusId'} = $object->getStatusId();
        }
        if (null !== $object->getName()) {
            $data->{'name'} = $object->getName();
        }
        if (null !== $object->getActive()) {
            $data->{'active'} = $object->getActive();
        }
        if (null !== $object->getDefault()) {
            $data->{'default'} = $object->getDefault();
        }
        if (null !== $object->getLinks()) {
            $data->{'links'} = $this->serializer->serialize($object->getLinks(), 'raw', $context);
        }

        return $data;
    }
}
