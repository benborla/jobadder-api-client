<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class CandidateVideoModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\CandidateVideoModel') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\CandidateVideoModel) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\CandidateVideoModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'type')) {
            $object->setType($data->{'type'});
        }
        if (property_exists($data, 'url')) {
            $object->setUrl($data->{'url'});
        }
        if (property_exists($data, 'reference')) {
            $object->setReference($data->{'reference'});
        }
        if (property_exists($data, 'createdAt')) {
            $object->setCreatedAt(\DateTime::createFromFormat("Y-m-d\TH:i:sP", $data->{'createdAt'}));
        }
        if (property_exists($data, 'updatedAt')) {
            $object->setUpdatedAt(\DateTime::createFromFormat("Y-m-d\TH:i:sP", $data->{'updatedAt'}));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getType()) {
            $data->{'type'} = $object->getType();
        }
        if (null !== $object->getUrl()) {
            $data->{'url'} = $object->getUrl();
        }
        if (null !== $object->getReference()) {
            $data->{'reference'} = $object->getReference();
        }
        if (null !== $object->getCreatedAt()) {
            $data->{'createdAt'} = $object->getCreatedAt()->format("Y-m-d\TH:i:sP");
        }
        if (null !== $object->getUpdatedAt()) {
            $data->{'updatedAt'} = $object->getUpdatedAt()->format("Y-m-d\TH:i:sP");
        }

        return $data;
    }
}
