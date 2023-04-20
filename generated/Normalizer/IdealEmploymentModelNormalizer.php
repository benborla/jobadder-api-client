<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class IdealEmploymentModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\IdealEmploymentModel') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\IdealEmploymentModel) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\IdealEmploymentModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'position')) {
            $object->setPosition($data->{'position'});
        }
        if (property_exists($data, 'workType')) {
            $object->setWorkType($this->serializer->deserialize($data->{'workType'}, 'BenBorla\\JobAdder\\V2\\Model\\WorkTypeModel', 'raw', $context));
        }
        if (property_exists($data, 'salary')) {
            $object->setSalary($this->serializer->deserialize($data->{'salary'}, 'BenBorla\\JobAdder\\V2\\Model\\SalaryRangeModel', 'raw', $context));
        }
        if (property_exists($data, 'other')) {
            $values = [];
            foreach ($data->{'other'} as $value) {
                $values[] = $this->serializer->deserialize($value, 'BenBorla\\JobAdder\\V2\\Model\\IdealSalaryModel', 'raw', $context);
            }
            $object->setOther($values);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getPosition()) {
            $data->{'position'} = $object->getPosition();
        }
        if (null !== $object->getWorkType()) {
            $data->{'workType'} = $this->serializer->serialize($object->getWorkType(), 'raw', $context);
        }
        if (null !== $object->getSalary()) {
            $data->{'salary'} = $this->serializer->serialize($object->getSalary(), 'raw', $context);
        }
        if (null !== $object->getOther()) {
            $values = [];
            foreach ($object->getOther() as $value) {
                $values[] = $this->serializer->serialize($value, 'raw', $context);
            }
            $data->{'other'} = $values;
        }

        return $data;
    }
}
