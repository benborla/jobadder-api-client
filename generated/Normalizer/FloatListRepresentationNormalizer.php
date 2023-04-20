<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class FloatListRepresentationNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\FloatListRepresentation') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\FloatListRepresentation) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\FloatListRepresentation();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'items')) {
            $values = [];
            foreach ($data->{'items'} as $value) {
                $values[] = $this->serializer->deserialize($value, 'BenBorla\\JobAdder\\V2\\Model\\FloatSummaryModel', 'raw', $context);
            }
            $object->setItems($values);
        }
        if (property_exists($data, 'totalCount')) {
            $object->setTotalCount($data->{'totalCount'});
        }
        if (property_exists($data, 'links')) {
            $object->setLinks($this->serializer->deserialize($data->{'links'}, 'BenBorla\\JobAdder\\V2\\Model\\PageLinks', 'raw', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getItems()) {
            $values = [];
            foreach ($object->getItems() as $value) {
                $values[] = $this->serializer->serialize($value, 'raw', $context);
            }
            $data->{'items'} = $values;
        }
        if (null !== $object->getTotalCount()) {
            $data->{'totalCount'} = $object->getTotalCount();
        }
        if (null !== $object->getLinks()) {
            $data->{'links'} = $this->serializer->serialize($object->getLinks(), 'raw', $context);
        }

        return $data;
    }
}
